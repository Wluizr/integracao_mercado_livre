<?php

namespace App\Http\Controllers;

use App\Models\MercadoLivreTokens;
use App\Services\ApiUserMLServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class UserMLController extends Controller
{    
    protected $baseURL;
    protected $appId;
    protected $secretKey;
    protected $initialCode;
    protected $redirectURI;
    protected $bearerToken;
    protected readonly MercadoLivreTokens $userTokens;

    public function __construct()
    {
        $this->baseURL = config('userML.base_url');
        $this->appId = config('userML.app_id');
        $this->secretKey = config('userML.secret_key');
        $this->initialCode = config('userML.initial_code');
        $this->redirectURI = config('userML.redirect_uri');
        $this->userTokens = new MercadoLivreTokens;
        
    }

    public function getLastTokenValid()
    {
        $tokens = $this->userTokens
                    ->where('created_at', '<', now())
                    ->where('is_valid', '=', '1')                    
                    ->orderBy('created_at', 'desc')
                    ->get();

        foreach ($tokens as $key => $token) {

            // Verifica a data de expiração
            $data = Carbon::create($token->created_at);
            $data->addSecond(intval($token->expires_in));

            $diff = $data->floatDiffInHours(Carbon::now()); // Descobre quanto tempo falta para expirar
            
            if($diff > -1 ){ // Restando 1 hora para expirar então atualiza;
                $this->refreshToken($token->refresh_token, $token->user_id);
            }
        }

        return $tokens;
    }

    
    public function refreshToken($lastTokenValid, $user_id)
    {
        Log::info("Atualizando token ");
        // dd($lastTokenValid);
        try{
            $response = Http::post($this->baseURL."/oauth/token", [
                'grant_type'      => 'refresh_token',
                'client_id'       => $this->appId,
                'client_secret'   => $this->secretKey,
                'refresh_token'   => $lastTokenValid,
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                Log::info($data);

                $this->deactivateOldTokens($user_id); // Primeiro desativa todos os tokens antigos daquele usuário.

                $data['is_valid'] = 1;

                $this->store($data);                

                return response()->json("OK - token atualizado | {$this->bearerToken} ");
            }
          
        }catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()." \n<br> Falha ao buscar o token", 'code' => $th->getCode()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request = [])
    {
        try {
            // dd($request);
            Log::info("Salvando novo token: ");
            $response = $this->userTokens->create($request);


        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()." \n<br> Erro ao cadastrar um novo token. Revise os parâmetros", 'code' => $th->getCode()], 500);
        }

        Log::info("sucesso: {$response}");
        return response()->json($response);
    }


    public function deactivateOldTokens($user_id)
    {
        try{
            $update = $this->userTokens
                ->where('user_id', $user_id)
                ->update([
                    "is_valid" => false,
                ]);

            Log::info("INATIVADO COM sucesso: {$update}");
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()." \n<br> Erro ao inativar os tokens antigos.", 'code' => $th->getCode()], 500);
        }

        return response()->json($update);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
