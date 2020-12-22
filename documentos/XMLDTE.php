<?php

include "XMLVariablesDTE.php";

$xml=new XMLWriter();
$xml->openMemory();
$xml->startDocument('1.0', 'ISO-8859-1');

//Elemento DTE
$xml->startElementNS(null, "DTE", "http://www.sii.cl/SiiDte");
    $xml->startAttribute('version');
    $xml->text('1.0');
    $xml->endAttribute();
    $xml->writeAttributeNS('xmlns','xsi', null, 'http://www.w3.org/2001/XMLSchema-instance');
    
    //Elemento DocumentoID
    $xml->startElement('Documento');
    $xml->startAttribute('ID');
    $xml->text($DocumentoID);
    $xml->endAttribute();

        //Elemento Encabezado
            $xml->startElement('Encabezado');
    
            //Elemento IdDoc
                $xml->startElement('IdDoc');

                    $xml->startElement('TipoDTE');
                    $xml->text($TipoDTE);
                    $xml->endElement();

                    $xml->startElement('Folio');
                    $xml->text($Folio);
                    $xml->endElement();

                    $xml->startElement('FchEmis');
                    $xml->text($FechaEmision);
                    $xml->endElement();

                    $xml->startElement('TipoDespacho');
                    $xml->text("1");
                    $xml->endElement();

                    $xml->startElement('FmaPago');
                    $xml->text($FmaPago);
                    $xml->endElement();

                    $xml->startElement('FchVenc');
                    $xml->text($FechaVencimiento);
                    $xml->endElement();

            //Cerrar IdDoc
                $xml->endElement();

            //Elemento Emisor
                $xml->startElement('Emisor');

                    $xml->startElement('RUTEmisor');
                    $xml->text($RutEmisor);
                    $xml->endElement();

                    $xml->startElement('RznSoc');
                    $xml->text($RazonSocialEmisor);
                    $xml->endElement();

                    $xml->startElement('GiroEmis');
                    $xml->text($GiroEmisor);
                    $xml->endElement();

                    $xml->startElement('Arteco');
                    $xml->text($AcEcoEmisor);
                    $xml->endElement();

                    $xml->startElement('DirOrigen');
                    $xml->text($DirOrigen);
                    $xml->endElement();

                    $xml->startElement('CmnaOrigen');
                    $xml->text($ComunaOrigen);
                    $xml->endElement();

                    $xml->startElement('CiudadOrigen');
                    $xml->text($CiudadOrigen);
                    $xml->endElement();

                    $xml->startElement('CdgVendedor');
                    $xml->text($CodigoVendedor);
                    $xml->endElement();


            //Cerrar Emisor 
                $xml->endElement();

            //Elemento Receptor
                $xml->startElement('Receptor');

                    $xml->startElement('RUTRecep');
                    $xml->text($RutReceptor);
                    $xml->endElement();

                    $xml->startElement('CdgIntRecep');
                    $xml->text($CodIntReceptor);
                    $xml->endElement();

                    $xml->startElement('RznSocRecep');
                    $xml->text($RazonSocialReceptor);
                    $xml->endElement();

                    $xml->startElement('GiroRecep');
                    $xml->text($GiroReceptor);
                    $xml->endElement();

                    $xml->startElement('DirRecep');
                    $xml->text($DirReceptor);
                    $xml->endElement();

                    $xml->startElement('CmnaRecep');
                    $xml->text($ComunaReceptor);
                    $xml->endElement();

                    $xml->startElement('CiudadRecep');
                    $xml->text($CiudadReceptor);
                    $xml->endElement();

            //Cerrar Receptor
                $xml->endElement();

            //Elemento Totales
                $xml->startElement('Totales');

                    $xml->startElement('MntNeto');
                    $xml->text($MontoNeto);
                    $xml->endElement();

                    $xml->startElement('MntExe');
                    $xml->text($MontoExento);
                    $xml->endElement();

                    $xml->startElement('TasaIVA');
                    $xml->text($TasaIVA);
                    $xml->endElement();

                    $xml->startElement('IVA');
                    $xml->text($IVA);
                    $xml->endElement();

                    $xml->startElement('MntTotal');
                    $xml->text($MontoTotal);
                    $xml->endElement();

            //Cerrar Totales
                $xml->endElement();

        //Cerrar Encabezado
            $xml->endElement();



        //Elemento Detalle Productos -- Función If o While a implementar para mas de un acceso a la informacion.
        $xml->startElement('Detalle');

            $xml->startElement('NroLinDet');
            $xml->text($NroLinDet);
            $xml->endElement();

            $xml->startElement('CdgItem');

                $xml->startElement('TpoCodigo');
                $xml->text($TipoCodigo);
                $xml->endElement();

                $xml->startElement('VlrCodigo');
                $xml->text($ValorCodigo);
                $xml->endElement();

            $xml->endElement();

            $xml->startElement('NmbItem');
            $xml->text($NombreItem);
            $xml->endElement();

            $xml->startElement('QtyItem');
            $xml->text($CantidadItem);
            $xml->endElement();

            $xml->startElement('UnmdItem');
            $xml->text($UnidadMedida);
            $xml->endElement();

            $xml->startElement('PrcItem');
            $xml->text($PrecioItem);
            $xml->endElement();

            $xml->startElement('MontoItem');
            $xml->text($MontoItem);
            $xml->endElement();

        //Cerrar Detalle
        $xml->endElement();

        //Elemento TED
        $xml->startElement('TED');
        $xml->startAttribute('version');
        $xml->text('1.0');
        $xml->endAttribute();

            //SubElemento DD
            $xml->startElement('DD');

                $xml->startElement('RE');
                $xml->text($RE);
                $xml->endElement();

                $xml->startElement('TD');
                $xml->text($TD);
                $xml->endElement();

                $xml->startElement('F');
                $xml->text($F);
                $xml->endElement();

                $xml->startElement('FE');
                $xml->text($FE);
                $xml->endElement();

                $xml->startElement('RR');
                $xml->text($RR);
                $xml->endElement();

                $xml->startElement('RSR');
                $xml->text($RSR);
                $xml->endElement();

                $xml->startElement('MNT');
                $xml->text($MNT);
                $xml->endElement();

                $xml->startElement('IT1');
                $xml->text($IT1);
                $xml->endElement();

                $xml->startElement('CAF');
                    $xml->startAttribute('version');
                    $xml->text('1.0');
                    $xml->endAttribute();
                        $xml->startElement('DA');

                            $xml->startElement('RE');
                            $xml->text($RE);
                            $xml->endElement();

                            $xml->startElement('RS');
                            $xml->text($RazonSocialEmisor);
                            $xml->endElement();

                            $xml->startElement('TD');
                            $xml->text($TD);
                            $xml->endElement();

                            $xml->startElement('RNG');

                                $xml->startElement('D');
                                $xml->text($D);
                                $xml->endElement();

                                $xml->startElement('H');
                                $xml->text($H);
                                $xml->endElement();

                            $xml->endElement();

                            $xml->startElement('FA');
                            $xml->text($FA);
                            $xml->endElement();

                            $xml->startElement('RSAPK');

                                $xml->startElement('M');
                                $xml->text($M);
                                $xml->endElement();

                                $xml->startElement('E');
                                $xml->text($E);
                                $xml->endElement();

                            $xml->endElement();

                            $xml->startElement('IDK');
                            $xml->text($IDK);
                            $xml->endElement();

                        $xml->endElement();

                        $xml->startElement('FRMA');
                            $xml->startAttribute('algortirmo');
                            $xml->text($AlgoritmoFRMA);
                        $xml->endElement();

                $xml->endElement();

                $xml->startElement('TSTED');
                $xml->text($TSTED);
                $xml->endElement();
            
            //Fin Subelemento DD
            $xml->endElement();

            $xml->startElement('FRMT');

                $xml->startAttribute('algoritmo');
                $xml->text($AlgoritmoFRMT);
                $xml->endAttribute();

            $xml->endElement();

        //Fin TED
        $xml->endElement();

        $xml->startElement('TmstFirma');
        $xml->text($TMSTFirma);
        $xml->endElement();

    //Fin DocumentoID
    $xml->endElement();

    //Elemento Signature
    $xml->startElement('Signature');
        $xml->startAttribute('xmlns');
        $xml->text('http://www.w3.org/2000/09/xmldsig#');
        $xml->endAttribute();

        //SubElemento SignedInfo
        $xml->startElement('SignedInfo');

            $xml->startElement('CanonicalizationMethod');
                $xml->startAttribute('Algorithm');
                $xml->text('http://www.w3.org/TR/2001/REC-xml-c14n-20010315');
                $xml->endAttribute();
            $xml->endElement();

            $xml->startElement('SignatureMethod');
                $xml->startAttribute('Algorithm');
                $xml->text('http://www.w3.org/2000/09/xmldsig#rsa-sha1');
                $xml->endAttribute();
            $xml->endElement();

            $xml->startElement('Reference');
                $xml->startAttribute('URI');
                $xml->text($ReferenceURI);
                $xml->endAttribute();

                    $xml->startElement('DigestMethod');
                        $xml->startAttribute('Algorithm');
                        $xml->text('http://www.w3.org/2000/09/xmldsig#sha1');
                        $xml->endAttribute();
                    $xml->endElement();

                    $xml->startElement('DigestValue');
                    $xml->text($DigestValue);
                    $xml->endElement();

            
            $xml->endElement();        

        //Fin SignedInfo
        $xml->endElement();

        $xml->startElement('SignatureValue');
        $xml->text($SignatureValue);
        $xml->endElement();

        //Elemento KeyInfo
        $xml->startElement('KeyInfo');
            
            $xml->startElement('KeyValue');

                $xml->startElement('RSAKeyValue');

                    $xml->startElement('Modulus');
                    $xml->text($Modulus);
                    $xml->endElement();

                    $xml->startElement('Exponent');
                    $xml->text($Exponent);
                    $xml->endElement();

                $xml->endElement();

            $xml->endElement();

            $xml->startElement('X509Data');

                $xml->startElement('X509Certificate');
                $xml->text($XCertificate);
                $xml->endElement();

            $xml->endElement();

        //Fin KeyInfo
        $xml->endElement();

    //Fin Signature
    $xml->endElement();
    
//Fin DTE
$xml->endDocument();

//Escribir a Archivo
    file_put_contents('DTEService/XML/'.$FechaEmision.'_'.$TipoDTE.'_'.$Folio.'.xml', $xml->outputMemory());


?>