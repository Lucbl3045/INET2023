<?php

use PHPUnit\Framework\TestCase;

require_once("vendor/autoload.php");
require_once "middleware/env.php";
require_once "middleware/DB.php";

final class LoginTest extends TestCase
{
    /** @test */
    public function UserLogsInAsAdmin(): void
    {
        $this->expectException(AuthException::class);

        $hash = password_hash("12345678", PASSWORD_DEFAULT);
        $id = DB::register(null, $hash, "0");
        try{
            ob_start();
            Auth::logout();
        } catch (AuthException $e){
            ob_get_clean();
        }
        Auth::login($id,"12345678");
        Auth::admin();
    }

    /** @test */
    public function UserLogsInAsMedic(): void
    {
        $this->expectNotToPerformAssertions();

        $hash = password_hash("12345678", PASSWORD_DEFAULT);
        $id = DB::register(null, $hash, "0");
        try{
            ob_start();
            Auth::logout();
        } catch (AuthException $e){
            ob_get_clean();
        }
        Auth::login($id,"12345678");
        Auth::user();
    }


    /** @test */
    public function AdminLogsInAsAdmin(): void
    {
        $this->expectNotToPerformAssertions();

        $hash = password_hash("12345678", PASSWORD_DEFAULT);
        $id = DB::register(null, $hash, "1");
        try{
            ob_start();
            Auth::logout();
        } catch (AuthException $e){
            ob_get_clean();
        }
        Auth::login($id,"12345678");
        Auth::admin();
    }

    /** @test */
    public function AdminLogsInAsMedic(): void
    {
        $this->expectNotToPerformAssertions();

        $hash = password_hash("12345678", PASSWORD_DEFAULT);
        $id = DB::register(null, $hash, "1");
        try{
            ob_start();
            Auth::logout();
        } catch (AuthException $e){
            ob_get_clean();
        }
        Auth::login($id,"12345678");
        Auth::user();
    }
    
    /** @test */
    public function InexistantUserLogsIn(): void
    {
        try{
            ob_start();
            Auth::logout();
        } catch (AuthException $e){
            ob_get_clean();
        }
        $fail = Auth::login(243234823,"12345678");
        $this->assertSame($fail, false);
    }


    /** @test */
    public function WrongPasswordLogin(): void
    {



        $fail=true;
        try{
            $id = Auth::register(null, "12345678", "0");
            try{
                ob_start();
                Auth::logout();
            } catch (AuthException $e){
                ob_get_clean();
            }
            Auth::login($id,"12345679");
            Auth::user();
        } catch (Exception $e){
            $fail=false;
        }
        
        $this->assertSame($fail, false);

    }
    
}