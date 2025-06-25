<?php
namespace App\Controllers;

use App\Models\ConsultaModel;
use App\Models\ConsultaSinSesionModel;

class ConsultaController extends BaseController
{
public function enviar()
{
    log_message('debug', 'Método recibido: ' . $this->request->getMethod());
    helper('form');
    $session = session();

        $mensaje = $this->request->getPost('mensaje');
        $id_usuario = $session->get('id_usuario');
        $nombre = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');

        log_message('debug', 'Datos recibidos: nombre=' . ($nombre ?? '') . ', email=' . ($email ?? '') . ', mensaje=' . ($mensaje ?? '') . ', id_usuario=' . ($id_usuario ?? ''));

        if (!$mensaje || (!$id_usuario && (!$nombre || !$email))) {
            log_message('error', 'Faltan datos en el formulario');
            return redirect()->back()->with('error', 'Faltan datos en el formulario');
        }

        if ($id_usuario) {
            log_message('debug', 'Intentando insertar consulta CON sesión');
            $consultaModel = new \App\Models\ConsultaModel();
            $data = [
                'id_usuario' => $id_usuario,
                'mensaje' => $mensaje,
                'leido' => 1,
                'activo' => 1,
            ];
            if (!$consultaModel->insert($data)) {
                $error = $consultaModel->errors();
                log_message('error', 'Error al insertar consulta con sesión: ' . print_r($error, true));
                return redirect()->back()->with('error', 'Error al guardar la consulta (con sesión): ' . json_encode($error));
            }
            log_message('debug', 'Consulta CON sesión insertada correctamente: ' . print_r($data, true));
        } else {
            log_message('debug', 'Intentando insertar consulta SIN sesión');
            $consultaSinSesionModel = new \App\Models\ConsultaSinSesionModel();
            $data = [
                'nombre' => $nombre,
                'email' => $email,
                'mensaje' => $mensaje,
                'leido' => 1,
                'activo' => 1,
            ];
            if (!$consultaSinSesionModel->insert($data)) {
                $error = $consultaSinSesionModel->errors();
                log_message('error', 'Error al insertar consulta sin sesión: ' . print_r($error, true));
                return redirect()->back()->with('error', 'Error al guardar la consulta (sin sesión): ' . json_encode($error));
            }
            log_message('debug', 'Consulta SIN sesión insertada correctamente: ' . print_r($data, true));
        }

        log_message('debug', 'Redireccionando con éxito');
        return redirect()->to('/contacto')->with('exito', 'Consulta enviada correctamente.');
    }
}


