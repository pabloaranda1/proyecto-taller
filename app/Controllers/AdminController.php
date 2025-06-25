<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\ConsultaModel;
use App\Models\ConsultaSinSesionModel;
use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use App\Controllers\BaseController;

class AdminController extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function panel()
{
    // Leer filtro desde GET (?filtro=mes/año/total)
    $filtro = service('request')->getGet('filtro') ?? 'total';

    switch ($filtro) {
        case 'año':
            $ventasQuery = "SELECT SUM(total) as totalVentas FROM factura WHERE YEAR(fecha) = YEAR(CURDATE())";
            break;
        case 'mes':
            $ventasQuery = "SELECT SUM(total) as totalVentas FROM factura WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())";
            break;
        case 'total':
        default:
            $ventasQuery = "SELECT SUM(total) as totalVentas FROM factura";
            break;
    }

    $totalVentas = $this->db->query($ventasQuery)->getRow()->totalVentas ?? 0;

    // Productos con stock bajo
    $pocosStock = $this->db->query("SELECT COUNT(*) as pocosStock FROM producto WHERE stock < 5")->getRow()->pocosStock ?? 0;

    // Total de usuarios
    $totalUsuarios = $this->db->query("SELECT COUNT(*) as totalUsuarios FROM usuario")->getRow()->totalUsuarios ?? 0;

    // Total de productos
    $totalProductos = $this->db->query("SELECT COUNT(*) as totalProductos FROM producto")->getRow()->totalProductos ?? 0;

    // Producto más vendido
    $productoMasVendidoQuery = $this->db->query("
        SELECT p.nombre, SUM(fd.cantidad) as totalVendidos
        FROM detalle_factura fd
        JOIN producto p ON fd.id_producto = p.id_producto
        GROUP BY p.id_producto
        ORDER BY totalVendidos DESC
        LIMIT 1
    ");
    $productoMasVendido = $productoMasVendidoQuery->getNumRows() > 0 ? $productoMasVendidoQuery->getRow()->nombre : null;

    // Últimas 5 ventas
    $ultimasVentas = $this->db->query("
        SELECT f.id_factura, f.fecha, f.total, u.nombre as cliente
        FROM factura f
        JOIN usuario u ON f.id_usuario = u.id_usuario
        ORDER BY f.fecha DESC
        LIMIT 5
    ")->getResult();

    // Cantidad de productos por categoría
$productosPorCategoria = $this->db->query("
    SELECT categoria, COUNT(*) as cantidad
    FROM producto
    GROUP BY categoria
")->getResult();


    return view('pages/admin/panel', [
        'totalVentas' => $totalVentas,
        'filtro' => $filtro,
        'pocosStock' => $pocosStock,
        'totalUsuarios' => $totalUsuarios,
        'totalProductos' => $totalProductos,
        'productoMasVendido' => $productoMasVendido,
        'ultimasVentas' => $ultimasVentas,
        'productosPorCategoria' => $productosPorCategoria
    ]);
}

    // Listado de usuarios
    public function usuarios()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->where('activo', 1)->findAll();

        return view('pages/admin/usuarios', ['usuarios' => $usuarios]);
    }

    public function usuariosDesactivados()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->where('activo', 0)->findAll();

        return view('pages/admin/usuarios_desactivados', ['usuarios' => $usuarios]);
    }


    // Ver un usuario específico
    public function verUsuario($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuario no encontrado");
        }

        return view('pages/admin/ver_usuario', ['usuario' => $usuario]);
    }

    public function desactivarUsuario($id){
        $usuarioModel = new UsuarioModel();

        // Verificar si el usuario existe
        if (!$usuarioModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuario no encontrado");
        }

        // Desactivar usuario
        $usuarioModel->update($id, ['activo' => 0]);

        return redirect()->to('/admin/usuarios')->with('mensaje', 'Usuario desactivado correctamente');
    }

    public function reactivarUsuario($id)
    {
        $usuarioModel = new UsuarioModel();

        // Verificar si el usuario existe
        if (!$usuarioModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuario no encontrado");
        }

        // Reactivar usuario
        $usuarioModel->update($id, ['activo' => 1]);

        return redirect()->to('/admin/usuarios/desactivados')->with('mensaje', 'Usuario reactivado correctamente');
    }

    public function actualizarUsuario($id_usuario)
    {
        $request = service('request');

        $data = [
            'nombre' => $request->getPost('nombre'),
            'email' => $request->getPost('email'),
            'celular' => $request->getPost('celular'),
        ];

        $password = $request->getPost('password');
        $password_confirm = $request->getPost('password_confirm');

        if (!empty($password)) {
            if ($password === $password_confirm) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                return redirect()->back()->with('error', 'Las contraseñas no coinciden')->withInput();
            }
        }

        $usuarioModel = new UsuarioModel();
        $usuarioModel->update($id_usuario, $data);

        return redirect()->to('admin/usuarios/ver_usuario/' . $id_usuario)
                         ->with('success', 'Usuario actualizado correctamente');
    }

    // Mostrar facturas de un usuario
   public function mostrarFacturasUsuario($id_usuario)
{
    $facturaModel = new FacturaModel();
    $usuarioModel = new UsuarioModel();

    $facturas = $facturaModel->where('id_usuario', $id_usuario)->findAll();
    $usuario = $usuarioModel->find($id_usuario);

    return view('pages/admin/facturas_usuario', [
        'facturas' => $facturas,
        'usuario' => $usuario // <-- agrega esto
    ]);
}

    public function productos()
    {
        $query = $this->db->query("SELECT * FROM producto WHERE activo = 1");
        $productos = $query->getResult(); // devuelve un array de objetos

        return view('pages/admin/productos', ['productos' => $productos]);
    }

    public function productosDesactivados()
    {
        $productos = $this->db->table('producto')
        ->where('activo', 0)
        ->get()
        ->getResult();

        return view('pages/admin/productos_desactivados', ['productos' => $productos]);
    }


    public function agregarProducto()
    {
        return view('pages/admin/agregar_producto');
    }

    public function guardarProducto()
{
    $validation = \Config\Services::validation();

    $reglas = [
        'nombre'    => 'required|min_length[2]',
        'categoria' => 'required',
        'precio'    => 'required|numeric',
        'stock'     => 'required|integer',
        'imagen'    => 'uploaded[imagen]|is_image[imagen]',
        'imagen2'   => 'uploaded[imagen2]|is_image[imagen2]'
    ];

    if (!$this->validate($reglas)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $imagen      = $this->request->getFile('imagen');
    $imagen2     = $this->request->getFile('imagen2');
    $nombreImg1  = $imagen->getRandomName();
    $nombreImg2  = $imagen2->getRandomName();

    $imagen->move(ROOTPATH . 'assets/images/productos', $nombreImg1);
    $imagen2->move(ROOTPATH . 'assets/images/productos-background', $nombreImg2);

    $data = [
        'nombre'    => $this->request->getPost('nombre'),
        'categoria' => $this->request->getPost('categoria'),
        'precio'    => $this->request->getPost('precio'),
        'stock'     => $this->request->getPost('stock'),
        'imagen'    => $nombreImg1,
        'imagen2'   => $nombreImg2,
        'activo'    => 1
    ];

    $this->db->table('producto')->insert($data);

    return redirect()->to('/admin/productos')->with('mensaje', 'Producto agregado correctamente');
}


    public function eliminarProducto($id)
    {
        $this->db->table('producto')->where('id_producto', $id)->update(['activo' => 0, 'stock' => 0]);
        return redirect()->to('/admin/productos');
    }

    public function reactivarProducto($id)
    {
    $this->db->table('producto')->where('id_producto', $id)->update(['activo' => 1]);
    return redirect()->to('/admin/productos/desactivados');
    }

    /* editar producto */

    public function editarProducto($id)
{
    $producto = $this->db->table('producto')
        ->where('id_producto', $id)
        ->get()
        ->getRow();

    if (!$producto) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado");
    }

    return view('pages/admin/editar_producto', ['producto' => $producto]);
}

public function actualizarProducto($id)
{
    $validation = \Config\Services::validation();

    $reglas = [
        'nombre' => 'required|min_length[2]',
        'categoria' => 'required',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'imagen'    => 'uploaded[imagen]|is_image[imagen]',
        'imagen2'   => 'uploaded[imagen2]|is_image[imagen2]'
    ];

    if (!$this->validate($reglas)) {
        return redirect()->back()
        ->withInput()
        ->with('errors', $validation->getErrors());
    }

    $imagen      = $this->request->getFile('imagen');
    $imagen2     = $this->request->getFile('imagen2');
    $nombreImg1  = $imagen->getRandomName();
    $nombreImg2  = $imagen2->getRandomName();

    $imagen->move(ROOTPATH . 'assets/images/productos', $nombreImg1);
    $imagen2->move(ROOTPATH . 'assets/images/productos-background', $nombreImg2);

    $data = [
        'nombre'    => $this->request->getPost('nombre'),
        'categoria' => $this->request->getPost('categoria'),
        'precio'    => $this->request->getPost('precio'),
        'stock'     => $this->request->getPost('stock'),
        'imagen'    => $nombreImg1,
        'imagen2'   => $nombreImg2,
    ];

    $this->db->table('producto')
        ->where('id_producto', $id)
        ->update($data);

    return redirect()->to('/admin/productos')->with('mensaje', 'Producto actualizado correctamente');
}

/* Gestion de consultas */

public function consultas()
{
    $consultaModel = new \App\Models\ConsultaModel();
    $consultaSinSesionModel = new \App\Models\ConsultaSinSesionModel();

    $perPage = 10;
    $pageConSesion = (int) ($this->request->getGet('page_con_sesion') ?? 1);
    $pageSinSesion = (int) ($this->request->getGet('page_sin_sesion') ?? 1);

    // Usamos la conexión ya creada
    $builder = $this->db->table('consulta c');
    $builder->select('c.*, u.nombre, u.email, u.id_usuario');
    $builder->join('usuario u', 'c.id_usuario = u.id_usuario');
    $builder->orderBy('c.id_consulta', 'DESC');

    // Para contar total sin resetear
    $totalConSesion = $builder->countAllResults(false);

    // Obtenemos resultados con limit y offset
    $consultasConSesion = $builder->limit($perPage, ($pageConSesion - 1) * $perPage)->get()->getResultArray();

    // Consultas sin sesión
    $totalSinSesion = $consultaSinSesionModel->countAllResults(false);
    $consultasSinSesion = $consultaSinSesionModel->orderBy('id_consulta', 'DESC')->findAll($perPage, ($pageSinSesion - 1) * $perPage);

    $pager = \Config\Services::pager();

    return view('pages/admin/consultas', [
        'consultasConSesion' => $consultasConSesion,
        'consultasSinSesion' => $consultasSinSesion,
        'pager' => $pager,
        'totalConSesion' => $totalConSesion,
        'totalSinSesion' => $totalSinSesion,
        'perPage' => $perPage,
        'pageConSesion' => $pageConSesion,
        'pageSinSesion' => $pageSinSesion,
    ]);
}

public function cambiarEstado($tipo = null, $id = null)
{
    if ($this->request->isAJAX() && in_array($tipo, ['con_sesion', 'sin_sesion']) && is_numeric($id)) {
        $model = $tipo === 'con_sesion'
            ? new \App\Models\ConsultaModel()
            : new \App\Models\ConsultaSinSesionModel();

        $consulta = $model->find($id);
        if (!$consulta) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Consulta no encontrada']);
        }

        $nuevoEstado = $consulta['leido'] ? 0 : 1;
        $model->update($id, ['leido' => $nuevoEstado]);

        return $this->response->setJSON([
            'status' => 'ok',
            'nuevoEstado' => $nuevoEstado,
            'label' => $nuevoEstado ? 'Leído' : 'No leído',
            'tooltip' => $nuevoEstado ? 'Marcar como no leído' : 'Marcar como leído'
        ]);
    }

    return $this->response->setJSON(['status' => 'error', 'message' => 'Solicitud inválida']);
}

public function toggleLeido($id)
{
    $consultaModel = new \App\Models\ConsultaModel();
    $consulta = $consultaModel->find($id);

    if ($consulta) {
        $nuevoEstado = $consulta['leido'] ? 0 : 1;
        $consultaModel->update($id, ['leido' => $nuevoEstado]);
    }

    return redirect()->back();
}

public function toggleLeidoSinSesion($id)
{
    $consultaModel = new \App\Models\ConsultaSinSesionModel();
    $consulta = $consultaModel->find($id);

    if ($consulta) {
        $nuevoEstado = $consulta['leido'] ? 0 : 1;
        $consultaModel->update($id, ['leido' => $nuevoEstado]);
    }

    return redirect()->back();
}

public function verConsulta($id)
{
    $model = new \App\Models\ConsultaModel();
    $consulta = $model->select('consulta.*, usuario.nombre, usuario.email')
                      ->join('usuario', 'usuario.id_usuario = consulta.id_usuario')
                      ->find($id);

    if (!$consulta) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Consulta no encontrada");
    }

    return view('pages/admin/consulta', [
        'consulta' => $consulta,
        'rutaToggleLeido' => 'admin/consultas/toggleLeido'
    ]);
}

}