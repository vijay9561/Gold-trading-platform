<?php
tcpdf();
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Suvarnasiddhi');
$pdf->SetTitle('Suvarnasiddhi');
$pdf->SetSubject('');
$pdf->SetKeywords('suvarnasiddhi,Glod');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintFooter(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('dejavusans', '', 10);
// add a page
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
//$img_file = K_PATH_IMAGES . 'backgroundimg.jpg';
//$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();
$loan_id=$_GET['inovice_id'];
$userid=$this->session->userdata('USERID');
$loan=$this->db->query("select *from TRADE where ID='$loan_id' and USERID='$userid'")->row();
$html = '<span>'
        . '<br><span style="font-size:14px;text-align:left;color:gray;">Suvarnasiddhi Buy Trade Invoice'
        . '</span>'
        . '</span>';
// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

$html = '<span style="text-align:center;font-size:20px;text-transform:uppercase;">Suvarnasiddhi Buy Trade INVOICE'
        . '<br><span style="font-size:14px;color:gray;text-transform:none">Inoice Date : ' .date('d-m-Y'). '</span>'
        . '</span><br>';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

/*$html = '<table style="border-top:1px solid #F4B41E;border-bottom:1px solid #F4B41E;width:100%;">'
        . '<tr style="color:brown;font-style:oblique;">
                <td style="height:20px;width:50%;">
                    <span><br>Prepared By</span>                     
                </td>
                <td>
                 <span><br>Prepared For<br></span>
                </td>
            </tr>'
        . '<tr style="color:black;font-style:oblique;">
                <td style="height:20px;">
                     <span><b>Growese</b></span>
                </td>
                
                <td>
                 <span><span><b>' . $this->session->userdata('usernames') . '</b></span></span>
                </td>
            </tr>'
        . '<tr style="color:black;font-style:oblique;">
                <td>
                <span>Open Source Crypto Network.      
                </span><br>
                <span>Mail us : support@growese.com   
                </span><br>
                              
</td>
                <td>
                <span>Email : ' . $this->session->userdata('emailids') . '</span><br>
                 	<span>Contact : +91-' . $this->session->userdata('contactnos') . '</span>
                </td>
            </tr>'
        . '</table>';*/

// output the HTML content
$TOTAL=$loan->TOTAL_INR+$loan->GST;
$html = '<br><br><br><span style="text-align:center;font-size:18px;font-weight:bold;text-decoration:underline;">BUY GOLD Particulars</span><br><br><div style="">'
        . '<br><br>'
        . '<span><table border="1" style="border-collapse: collapse; width:600px; padding:10px; color:#000; text-align:left; font-size:12px;">'
       . '<tr><th>Trade ID : </th><td>' .$loan->TRADE_ID. '</td></tr>'
        . '<tr><th>Trade Date : </th><td>' .date('d-m-Y', strtotime($loan->DATES)) . '</td></tr>'
         .'<tr><th>Gold Weight:&nbsp;</th><td>' .$loan->GOLD_WEIGHT. ' gm</td></tr>'
        .'<tr><th>GST AMOUNT:&nbsp;</th><td>INR ' .$loan->GST. '</td></tr>'
        .'<tr><th>Net Amount:&nbsp;</th><td>INR ' .$loan->TOTAL_INR. '</td></tr>'
        .'<tr><th>Total Amount:&nbsp;</th><td>INR ' .$TOTAL. '</td></tr>'
       .'<tr><th>Trade Status:&nbsp;</th><td>' .$loan->STATUS. '</td></tr>'
        . '</table></span>';
       $html.='</div>';
// footer the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
$html = '<br><br><br><br><div style="text-align:center;font-size:25px;text-transform:uppercase;border-bottom:1px solid #F4B41E;">thank you'
        . '<br><span style="font-size:12px;color:gray;text-transform:none">http://www.suvarnasiddhi.com/</span><br>'
        . '</div>'
        . '<div>'
        . '<br><span style="font-size:11px;color:gray;text-transform:none">1. This is computer generated invoice it does not need signature.</span>'
        . '<br><span style="font-size:11px;color:gray;text-transform:none">3. Incase any concern please address us on support@suvarnasiddhi.com</span>'
        . '</div>';
// footer the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('Suvarnasiddhi_Invoice-' .$loan->TRADE_ID. '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
