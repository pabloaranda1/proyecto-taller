<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

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
        $usuarios = $usuarioModel->findAll();

        return view('admin/usuarios', ['usuarios' => $usuarios]);
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
    
    public function productos()
    {
        $query = $this->db->query("SELECT * FROM producto WHERE activo = 1");
        $productos = $query->getResult(); // devuelve un array de objetos

        return view('pages/admin/productos', ['productos' => $productos]);
    }

    public function agregarProducto()
    {
        return view('pages/admin/agregar_producto');
    }

    public function guardarProducto()
    {
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'categoria' => $this->request->getPost('categoria'),
            'precio' => $this->request->getPost('precio'),
            'stock' => $this->request->getPost('stock'),
            'imagen' => $this->request->getFile('imagen')->getName(),
            'imagen2' => $this->request->getFile('imagen2')->getName(),
        ];

        $this->db->table('producto')->insert($data);
        return redirect()->to('admin/productos');
    }

    public function eliminarProducto($id)
    {
        $this->db->table('producto')->delete(['id_producto' => $id]);
        return redirect()->to('/admin/productos');
    }
}