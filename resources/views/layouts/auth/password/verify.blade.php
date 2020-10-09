<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Plantilla</title>
    </head>

    <style>

        .content {
            background-color: #f3f7ff;
            display:          flex;
            font-family:      'open sans', Arial, Helvetica, sans-serif;
            height:           100vh;
        }

        .wp {
            padding-top: 10px;
            max-width:   600px;
            width:       100%;
            text-align:  center;
            display:     table;
            margin:      0 auto;
        }

        .content_img {
            width:       100%;
            text-align:  left;
            padding-top: 10px;
        }

        .content_img > img {
            max-width: 138px;
            padding:   10px;
        }

        .content_text {
            text-align:       left;
            padding:          40px 0;
            background-color: #ffffff;
            display:          flex;
            justify-content:  center;
            border-radius:    4px;
        }

        .content_text_div {
            width:   85%;
            color:   #0c1b46;
            margin:  0 auto;
            display: grid;
        }

        .name {
            font-family: 'open sans', Arial, Helvetica, sans-serif;
            width:       100%;
            color:       #2962ff;
            font-size:   32px;
            text-align:  center;
        }

        .text {
            padding-top:    30px;
            padding-bottom: 15px;
            text-align:     justify !important;
            font-size:      14px;
            line-height:    24px;
        }

        .content_btn {
            text-align: center;
            padding:    30px 0 30px;
            cursor:     pointer;
        }

        .content_btn > a > button {
            background:    #2962ff;
            border-radius: 4px;
            box-shadow:    none;
            height:        38px;
            font-size:     16px;
            color:         white;
            padding:       .375rem .75rem;
            border:        2px solid #2962ff;
            cursor:        pointer;
            font-weight:   bold;
        }

        .content_att {
            display:     grid;
            font-size:   13px;
            line-height: 20px;
        }

        .text-center {
            text-align: center !important;
        }

        .pt-10 {
            padding-top: 10px !important;
        }

        .f-16 {
            font-size: 16px !important;
        }


    </style>

    <body>
        <div class="content">
            <div class="wp">
                <div class="content_img">
                    <img src="{{ config('quick.login.logo') }}" alt="">
                </div>
                <div class="content_text">
                    <div class="content_text_div">

                        <span class="greeting">
                            <strong>Estimado/a: {{ $names }}</strong>
                        </span>


                        <span class="text f-16">Estás recibiendo este email porque se ha solicitado un cambio de contraseña para tu cuenta</span>

                        <div class="content_btn">
                            <a href="{{ $link }}">
                                <button type="button">Restablecer contraseña</button>
                            </a>
                        </div>

                        <span class="text f-16">Este enlace para restablecer la contraseña caduca en 60 minutos.</span>
                        <span class="text f-16">Si no has solicitado un cambio de contraseña, puedes ignorar o eliminar este e-mail.</span>


                        <div class="content_att">
                            <span>Atentamente,</span>
                            <span>{{ config('quick.text.name') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
