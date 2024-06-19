<?php

namespace app\Dominio\Usuario;

class Usuario
{

    private Profissao $profissao;
    // private $id_escolaridade;
    private Escolaridade $escolaridade;
    // private $id_cidade;
    // private $id_cidade;
    private $id_usuario;
    private $nome_usuario;
    private $email;
    private $data_nascimento;
    private $sexo;
    private $senha;
    private $login;
    private $nivel_acesso;
    private $status_usuario;

    /**
     * Get the value of id_usuario
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     */
    public function setIdUsuario($id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of nome_usuario
     */
    public function getNomeUsuario()
    {
        return $this->nome_usuario;
    }

    /**
     * Set the value of nome_usuario
     */
    public function setNomeUsuario($nome_usuario): self
    {
        $this->nome_usuario = $nome_usuario;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of data_nascimento
     */
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * Set the value of data_nascimento
     */
    public function setDataNascimento($data_nascimento): self
    {
        $this->data_nascimento = $data_nascimento;

        return $this;
    }

    /**
     * Get the value of sexo
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set the value of sexo
     */
    public function setSexo($sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     */
    public function setSenha($senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of nivel_acesso
     */
    public function getNivelAcesso()
    {
        return $this->nivel_acesso;
    }

    /**
     * Set the value of nivel_acesso
     */
    public function setNivelAcesso($nivel_acesso): self
    {
        $this->nivel_acesso = $nivel_acesso;

        return $this;
    }

    /**
     * Get the value of status_usuario
     */
    public function getStatusUsuario()
    {
        return $this->status_usuario;
    }

    /**
     * Set the value of status_usuario
     */
    public function setStatusUsuario($status_usuario): self
    {
        $this->status_usuario = $status_usuario;

        return $this;
    }

    /**
     * Get the value of login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     */
    public function setLogin($login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Get the value of profissao
     *
     * @return Profissao
     */
    public function getProfissao(): Profissao {
        return $this->profissao;
    }

    /**
     * Set the value of profissao
     *
     * @param Profissao $profissao
     *
     * @return self
     */
    public function setProfissao(Profissao $profissao): self {
        $this->profissao = $profissao;
        return $this;
    }

    /**
     * Get the value of escolaridade
     *
     * @return Escolaridade
     */
    public function getEscolaridade(): Escolaridade {
        return $this->escolaridade;
    }

    /**
     * Set the value of escolaridade
     *
     * @param Escolaridade $escolaridade
     *
     * @return self
     */
    public function setEscolaridade(Escolaridade $escolaridade): self {
        $this->escolaridade = $escolaridade;
        return $this;
    }
}