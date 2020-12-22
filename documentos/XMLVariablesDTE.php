<?php


$date  = date('Y-m-d H:i:s');

//Id Documento
$DocumentoID="T61F2458";
$TipoDTE=61;
$Folio=2458;
$FechaEmision="2020-02-03";
$FmaPago=1;
$FechaVencimiento="2020-02-03";

//Emisor

$RutEmisor=89371100-7;
$RazonSocialEmisor="REPETTO Y GAJARDO LIMITADA";
$GiroEmisor="MATERIALES DE CONSTRUCCION-PINTURAS-ARTICULOS ELECTRICOS-MENAJE-HERRAMIENTAS";
$AcEcoEmisor=523410; //Codigo de Actividad Economico.
$DirOrigen="Av. Egana 897";
$ComunaOrigen="PENALOLEN";
$CiudadOrigen="SANTIAGO";
$CodigoVendedor="JESUS ALONSO";

//Receptor

$RutReceptor=7169492-5;
$CodIntReceptor=16710; //Codigo Interno del Receptor
$RazonSocialReceptor="LUIS SALAS";
$GiroReceptor="PARTICULAR";
$DirReceptor="EL GRUMETE 987";
$ComunaReceptor="NUNOA";
$CiudadReceptor="SANTIAGO";

//Totales

$MontoNeto=8908;
$MontoExento=0;
$TasaIVA=19;
$IVA=1693;
$MontoTotal=10601;

//Detalles

$NroLinDet=1; //Numero Secuencial de Linea
$TipoCodigo="INT1"; //Tipo de Codificacion Item
$ValorCodigo=11192; //Codigo del Item para valoracion particular.
$NombreItem="RUEDA PORTON 3 C/PERNO 100KG APROX.";
$CantidadItem=2;
$UnidadMedida="UNID";
$PrecioItem=4453.781513; //Precio unitario del Item
$MontoItem=8908; 

//DD

$RE=$RutEmisor; //Rut Emisor
$TD=$TipoDTE; //Tipo DTE
$F=$Folio; //Folio
$FE=$FechaEmision; //Fecha Emision
$RR=$RutReceptor; //RutReceptor
$RSR=$RazonSocialReceptor; //Razon Social Receptor
$MNT=$MontoTotal; //Monto Total DTE
$IT1=$NombreItem; // Descripcion Primer Item

//CAF
    //Datos Autorizacion Folio

$REF=$RutEmisor; //RutEmisor
$RSE=$RazonSocialEmisor; //RazonSocial Emisor
$TDF=$TipoDTE; //TipoDTE

        //Rango Autorizado Folio

$D=2304; //Folio Inicial (Desde)
$H=2553; //Folio Final (Hasta)
$FA="2019-10-30";

    //Clave Publica RSA Del Solicitante

$M="2XLhV9zQzirPmIavHTd+d3mHparOrtjh4EgNo/Xvrb7UdtiiHNN/MmmBlQPb13642ooO/zOtJgWVZ0VUpm7RlQ=="; //Modulo RSA
$E="Aw=="; //Exponente RSA

    //Identificador de Llave

$IDK=300;


$AlgoritmoFRMA="H3/2aFgXscD1n53tfs5sjT3lRMerQ/3pih1FlkBjzsDwokFQ3ry6ogWCIVEqFvMX9Z2G7YdA3DXSETzYqXlmGw==";  //Firma Digital (RSA) del SII Sobre DA

$TSTED="2020-02-03T09:48:19"; //TimeStamp de Generacion del Timbre

$AlgoritmoFRMT="VKwNAqW2oaqwLpyTlm2QdSN+MB+fUvStJoE6dwmo+QkC+BigyG1wTYiynSQJWdKmKKWrptW5kLe8 ThTEouG2Mw=="; //Valor de Firma Digital  sobre DD

$TMSTFirma="2020-02-03T09:48:19"; //Fecha y Hora en que se Firmo Digitalmente el Documento AAAA-MM-DDTHH:MI:SS

$ReferenceURI="#T61F2458"; //Referencia elemento Firmado Formato : [#T{TipoDocumento}F{NumeroDeFolio}]

$DigestValue="FcvnC5cutuGsku1kwW9IPajg+sQ="; //Valor de Digest

$SignatureValue="GJfX+u0Oy4qNM+lgGD34TalXtCRwH+oMriEehc/jy0PEM6+FPnxpd8fdRu4tvj3LRzj4ne10FmvJ bAbQrd4mRuk6TUr65zwZyMP17inC3Vw4SU9DRQ3dE/jOKy2Xi5nuKzXzVx00+CpoCZh8zgkeAstP FkmM+9ln1hzNNmjXebh3ylQnP37TkdYtd6iRvGBImQMBZ2rVC67JgH/ykm8jXD02CcCKjZzm3Jq+ m8ZAvHZjK2XKTwWBql1OrC7yn5/9SwGXclKUAFVpIDfM73M0Mck2R1aJhG9Ym1Vrs/I7Iaotyh1w kJ3Ju0BiJwXzYPBPnnua0EMVCTIi9DYvpNbl5A=="; //Valor Firma Digital

$Modulus="xqPrhCwxPPFmTS0SXXSL5UgTIj29iYL5SRI6KuL3nlrRvEhVzjuHqGNTNXy0kBBO/iPCZOtdjnKe Ece9axHtZywT8JyNogz70O4HUFdXZYSLrXcp9git6jF2ud0Au6yElG3PZL42H/9KTnjsOsfx2bHb N44+KUGBrXODjbYX+IE/6BpixD57gTd4q8BJp3yxSKK80ZjbdzmEhNC0QJ4oiK+VgXaA9mox8TRg lzQ9C9PH276s0EHARHxCo3RLCjnVFsMo14tBONq/pwB1MWj+nasO2Etb7Q85dJZT/EPpUBQ6Dhpf 8ZAyiemErEa/lEGTV77MQrHvLSQK5+vW279/6Q=="; //Modulo Clave RSA

$Exponent="AQAB"; //Exponente Clave RSA

$XCertificate="MIIGcDCCBVigAwIBAgIDAjPAMA0GCSqGSIb3DQEBCwUAMIGmMQswCQYDVQQGEwJDTDEYMBYGA1UE ChMPQWNlcHRhLmNvbSBTLkEuMUgwRgYDVQQDEz9BY2VwdGEuY29tIEF1dG9yaWRhZCBDZXJ0aWZp Y2Fkb3JhIENsYXNlIDIgUGVyc29uYSBOYXR1cmFsIC0gRzQxHjAcBgkqhkiG9w0BCQEWD2luZm9A YWNlcHRhLmNvbTETMBEGA1UEBRMKOTY5MTkwNTAtODAeFw0xODA2MDQxNDA1NDFaFw0yMDA2MDQx NDA1NDFaMIGLMQswCQYDVQQGEwJDTDEYMBYGA1UEDBMPUEVSU09OQSBOQVRVUkFMMSswKQYDVQQD EyJST0RSSUdPIEFMRUpBTkRSTyBHQUpBUkRPIENJU1RFUk5BMSEwHwYJKoZIhvcNAQkBFhJhbGVz Z2FyZUBnbWFpbC5jb20xEjAQBgNVBAUTCTYwOTgxODMtMzCCASIwDQYJKoZIhvcNAQEBBQADggEP ADCCAQoCggEBAMaj64QsMTzxZk0tEl10i+VIEyI9vYmC+UkSOiri955a0bxIVc47h6hjUzV8tJAQ Tv4jwmTrXY5ynhHHvWsR7WcsE/CcjaIM+9DuB1BXV2WEi613KfYIreoxdrndALushJRtz2S+Nh// Sk547DrH8dmx2zeOPilBga1zg422F/iBP+gaYsQ+e4E3eKvASad8sUiivNGY23c5hITQtECeKIiv lYF2gPZqMfE0YJc0PQvTx9u+rNBBwER8QqN0Swo51RbDKNeLQTjav6cAdTFo/p2rDthLW+0POXSW U/xD6VAUOg4aX/GQMonphKxGv5RBk1e+zEKx7y0kCufr1tu/f+kCAwEAAaOCAr4wggK6MB8GA1Ud IwQYMBaAFGWlqz4/yLZRbRF+X8MKB+ZDoAi2MB0GA1UdDgQWBBRJQ96zou5RSnp1ehwPmrwbXrhb 6jALBgNVHQ8EBAMCBPAwHQYDVR0lBBYwFAYIKwYBBQUHAwIGCCsGAQUFBwMEMBEGCWCGSAGG+EIB AQQEAwIFoDCB9QYDVR0gBIHtMIHqMIHnBggrBgEEAbVrAjCB2jAxBggrBgEFBQcCARYlaHR0cHM6 Ly9hY2c0LmFjZXB0YS5jb20vQ1BTLUFjZXB0YWNvbTCBpAYIKwYBBQUHAgIwgZcwFhYPQWNlcHRh LmNvbSBTLkEuMAMCAQkafUVsIHRpdHVsYXIgaGEgc2lkbyB2YWxpZGFkbyBlbiBmb3JtYSBvbmxp bmUsIHF1ZWRhbmRvIGhhYmlsaXRhZG8gZWwgQ2VydGlmaWNhZG8gcGFyYSB1c28gdHJpYnV0YXJp bywgcGFnb3MsIGNvbWVyY2lvIHkgb3Ryb3MuMFoGA1UdEgRTMFGgGAYIKwYBBAHBAQKgDBYKOTY5 MTkwNTAtOKAkBggrBgEFBQcIA6AYMBYMCjk2OTE5MDUwLTgGCCsGAQQBwQECgQ9pbmZvQGFjZXB0 YS5jb20wWwYDVR0RBFQwUqAXBggrBgEEAcEBAaALFgk2MDk4MTgzLTOgIwYIKwYBBQUHCAOgFzAV DAk2MDk4MTgzLTMGCCsGAQQBwQECgRJhbGVzZ2FyZUBnbWFpbC5jb20wRwYIKwYBBQUHAQEEOzA5 MDcGCCsGAQUFBzABhitodHRwczovL2FjZzQuYWNlcHRhLmNvbS9hY2c0L29jc3AvQ2xhc2UyLUc0 MD8GA1UdHwQ4MDYwNKAyoDCGLmh0dHBzOi8vYWNnNC5hY2VwdGEuY29tL2FjZzQvY3JsL0NsYXNl Mi1HNC5jcmwwDQYJKoZIhvcNAQELBQADggEBACJ3wiC7gOhauMrRAWbFXGQwK0mWoJ26kan1sNVl 8WhnXsgXkj38NZvJ+IhCuE4odCPxNp2z4/JTRt+Y/tB8YA+aPzbVrzDsGsesm0m0sFBH9lntktqT aK81D42brBiozbJ0rJ12ftWWRaKaRknQiXwGCUXij4GItjdTAaS3jyes0J8f1dZcWI9RzJ7vY0/X me4AxWLqwy45khSC5JiDgjIz37ns/avUK0MtS/5jKpLc9aIVlEVSyR5ZrBEur8VlxDaEQQAl4FJa ywTsZHqPgsJVT9OWjo+n+6OsacebUyBqlUyue5tPlL1fHEwfR0mOd/AuH416i4+zqjcKiCpNW0Q="; //CertificadoPublico X509.


?>