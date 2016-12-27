<?php

class Auditoria
{
    public $result;
    public $perfis;
    public $perfis2;

    function ListarAuditoria()
    {
        $auditoriaModel = new AuditoriaModel();
        $this->result = $auditoriaModel->PesquisaTodos();
    }

    function DetalharAuditoria()
    {
        $perfilControl = new Perfil();
        $auditoriaModel = new AuditoriaModel();
        $id = UrlAmigavel::PegaParametro("aud");
        /** @var AuditoriaEntidade result */
        $this->result = $auditoriaModel->PesquisaUmRegistro($id);
        $usuarioModel = new UsuarioModel();
        if($this->result->getCoUsuario()){
            /** @var UsuarioEntidade $usuario */
            $usuario = $usuarioModel->PesquisaUmRegistro($this->result->getCoUsuario()->getCoUsuario());
            $perfis = $perfilControl->montaComboPerfil($usuario);
            $this->perfis = implode(', ',$perfis);
        }else{
            $this->perfis = '';
        }
    }
}

?>
   