<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\Warning;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $parms = DB::select("select name, value from ds_parms where name = 'email'");
        foreach ($parms as $parm) {
            $toMail = $parm->value;
        }

        // $mail = new PHPMailer(true);
        // $mail = new PHPMailer();
        // try {
        //     //Server settings
        //     $mail->IsSMTP();                                            // Send using SMTP
        //     $mail->Host       = 'doublesquare.com.tw';                       // Set the SMTP server to send through
        //     $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        //     $mail->SMTPDebug = 3;                      // Enable verbose debug output
        //     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        //     $mail->Username   = 'editorial@doublesquare.com.tw';                   // SMTP username
        //     $mail->Password   = 'DSGallery__2138';                   // SMTP password
        //     $mail->Port       = 26;                       // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        //     $mail->CharSet = 'utf-8';   // 這裡指定字符集！
        //     $mail->Encoding = 'base64';
        //     //Recipients
        //     $mail->SetFrom($data['email'], $data['name']);
        //     $mail->AddAddress($toMail);        // Add a recipient
        //     //$mail->addAddress('ellen@example.com');               // Name is optional
        //     //$mail->addReplyTo('info@example.com', 'Information');
        //     $mail->addCC('editorial@doublesquare.com.tw');
        //     $mail->addBCC('jiro853141@gmail.com');

        //     //Attachments
        //     //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //     //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //     //Content
        //     $mail->isHTML(true);                                  // Set email format to HTML
        //     $mail->Subject = '作品詢問';
        //     $mail->Body    =
        //         '姓名: ' .$data['name']. '<br>'.
        //         'email: ' .$data['email']. '<br>'.
        //         '電話: ' .$data['phone']. '<br>'.
        //         '內容: ' .$data['content']. '<br>'.
        //         '詢價圖片鏈接:<br> <img src="' .$data['img_src']. '"/><br>'.
        //         '詢價頁面鏈接: ' .$data['exhibition_src']. '<br>';
        //     $mail->AltBody = 'text/html';

        //     if(!$mail->Send()) {
        //         $error = [
        //             'error' => 500
        //         ];

        //         return response()->json($error);
        //     }
        // } catch (Exception $e) {
        //     $error = [
        //         'error' => 500
        //     ];

        //     return response()->json($error);
        // }
        $to = collect([
            ['email' =>  $toMail]
        ]);

        // 提供給模板的參數
        $params = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'content' => $data['content'],
            'img_src' => $data['img_src'],
            'exhibition_src' => $data['exhibition_src'],
        ];

        // 若要直接檢視模板
        // echo (new Warning($data))->render();die;

        Mail::to($to)->cc(['editorial@doublesquare.com.tw', 'jiro853141@gmail.com'])->send(new Warning($params));

        return response()->json(null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
