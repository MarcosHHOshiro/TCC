<?php
namespace Http\Middleware;

use \App\ClientRegisterInit\Model\LoginModel;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth{

    /**
     * Método responsavel por retornar uma instancia de usuario autenticado
     * @param Request $request
     * @return void
     */
    private function getJWTAuthUser($request){
        $headers = $request->getHeaders();
        
        //toke puro em jwt
        $jwt = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : '';

        try{
            //decode
            $decode = (array)JWT::decode($jwt, new Key(getenv('JWT_KEY'), 'HS256'));
        }catch(\Exception $e){
            throw new \Exception("Token invalido", 403);
        }

        //login
        $login[] = $decode['login'] ?? '';

        //busca o usuario pelo login
        $obUser = LoginModel::getUsuarioByLogin("login = ?", null, null, "login, password_user", $login);

        //RETORNA O USUARIO
        return $obUser instanceof LoginModel ? $obUser : false;
    }

    /**método responsavel por validar o acesso via JWT
     * @param Request $requst
     */
    protected function auth($request){

        //VERIFICA O USUARIO RECEBIDO
        if($obUser = $this->getJWTAuthUser($request)){ 
            return $obUser;
        }

        //emite o erro de senha invalida
        throw new \Exception("Acesso negado", 403);
    }
        /**
     * Método responsavel por executar o middeware
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){
        //REALIZA A VALIDAÇÃO DO ACESSO VIA JWT
        $this->auth($request);


        return $next($request);
    }
}
