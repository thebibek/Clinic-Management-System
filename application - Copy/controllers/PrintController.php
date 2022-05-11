<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PrintController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TestModel', 'test');
        $this->load->model('PatientRegistrationModel', 'pr');
        $this->load->model('ReceiptModel', 'receipt');
        $this->load->model('ReportModel', 'report');
        $this->load->model('SettingsModel', 'settings');
        $this->load->model('SalaryModel', 'salary');
        $this->load->model('AttendanceModel', 'attendance');
    }

    public function printBill($receiptNo) {
        if (empty($receiptNo)) {
            redirect(base_url('app/receipt'));
            exit();
        }

        if (!is_numeric($receiptNo)) {
            redirect(base_url('app/receipt'));
            exit();
        }

        $ReceiptData = [
            'ReceiptNo' => $receiptNo
        ];


        if ($this->receipt->isExistReceiptNo($ReceiptData, 'receipt')) {
            $row = $this->receipt->supplyPrintReceipt($ReceiptData);
            //print_r($row);

            $receiptId = $row['ID'];
            $invoiceNo = $row['ReceiptNo'];
            $subtotal = $row['TotalAmount'];
            $discount = $row['Discount'];

            $total = $row['NetAmount'];

            $paid = $row['PaidAmount'];

            $due = $row['DueAmount'];




            //getting patient name,refer doctor receipt date etc.
            $rs1 = $this->receipt->ReceiptDetail($ReceiptData);


            //getting setting
            $rs2 = $this->settings->supplySettings();

            //receipt date

            $receiptDate = $this->appDateFormat($rs1['ReceiptDate'], $rs2['DateFormat']);
            $rs1['ReceiptDate'] = $receiptDate;

            $clinic = $rs2['LabName'];
            $address = $rs2['Address'];
            $tagLine = $rs2['TagLine'];
            $email = $rs2['Email'];
            $website = !empty($rs2['Website']) ? $rs2['Website'] : "";
            $regdNo = !empty($rs2['RegdNo']) ? $rs2['RegdNo'] : "";
            $phone1 = !empty($rs2['PhoneNo1']) ? $rs2['PhoneNo1'] : "";
            $phone2 = !empty($rs2['PhoneNo2']) ? $rs2['PhoneNo2'] : "";
            $labNo = !empty($rs2['LabNo']) ? $rs2['LabNo'] : "";
            $pathologist = !empty($rs2['TechnicianName']) ? $rs2['TechnicianName'] : "";
            $qualification = !empty($rs2['TechnicianQualification']) ? $rs2['TechnicianQualification'] : "";
            $note1 = !empty($rs2['FooterNote1']) ? $rs2['FooterNote1'] : "";
            $note2 = !empty($rs2['FooterNote2']) ? $rs2['FooterNote2'] : "";
            $note3 = !empty($rs2['FooterNote3']) ? $rs2['FooterNote3'] : "";

            //items to display
            $items = [
                'ReceiptID' => $receiptId
            ];
            $data = [
                'items' => $this->receipt->supplyItems($items),
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'paid' => $paid,
                'due' => $due,
                'rs1' => $rs1,
                'rs2' => $rs2
            ];
        } else {
            redirect(base_url('app/receipt'));
            exit();
        }


        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'autoMarginPadding' => 1
        ]);

        if ($rs2['IsPrintReportHeader'] == 0) {
            $mpdf->SetHTMLHeader('
<table width="100%">
<tr>
<td width="40%" style="color:#0000BB; ">
	<p><img src="assets/img/logo.png" width="50" height="50"><p>
		<p style="font-weight: bold; font-size: 14pt;">' . $clinic . '</p>
                <p>' . $tagLine . '</p>
                <p>' . $website . '</p>       
                
                 
	</td>
<td width="30%" style="text-align:left;">' . $address . '<br /><span style="font-family:dejavusanscondensed;">&#9742;</span> ' . $phone1 . '
<br /><span style="font-family:dejavusanscondensed;">&#9742;</span> ' . $phone2 . '
<p>' . $email . '</p>    
</td>
<td width="30%" style="text-align: right;">
Invoice No.<br />
<span style="font-weight: bold; font-size: 12pt;color:green">' . $invoiceNo . '</span><br>
Date: ' . $receiptDate . '
</td>
</tr>
</table>
<hr>');
            $mpdf->SetHTMLFooter('
<hr>            
<table width="100%">
    <tr>
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">Receipt</td>
    </tr>
</table>');
        } else {
            $mpdf->SetHTMLHeader('<br><br><br><br><br></br><br><hr>');
            $mpdf->SetHTMLFooter('<br><br><br>');
        }


        $html = $this->load->view('Bill/HtmlView', $data, TRUE);
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Invoice");
        $mpdf->SetAuthor($clinic);
        $mpdf->SetWatermarkText($clinic);
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);

        $mpdf->Output($invoiceNo . '_invoice.pdf', 'I');
    }

    public function printReport($receiptNo) {
        if (empty($receiptNo)) {
            redirect(base_url('app/report'));
            exit();
        }

        if (!is_numeric($receiptNo)) {
            redirect(base_url('app/report'));
            exit();
        }

        $ReceiptData = [
            'ReceiptNo' => $receiptNo
        ];

        if ($this->report->isExistReceiptNo($ReceiptData, 'testresult')) {
            $data = $this->report->supplyPrintReport($ReceiptData);

            //getting patient name,refer doctor receipt date etc.
            $rs1 = $this->receipt->ReceiptDetail($ReceiptData);

            //getting setting
            $rs2 = $this->settings->supplySettings();

            //receipt date

            $receiptDate = $this->appDateFormat($rs1['ReceiptDate'], $rs2['DateFormat']);
            $rs1['ReceiptDate'] = $receiptDate;

            $printDate = $this->appDateFormat(date('Y-m-d'), $rs2['DateFormat']);
            $rs1['PrintDate'] = $printDate;

            if (empty($rs1)) {
                $rs1['ReceiptNo'] = "";
                $rs1['TotalAmount'] = "";
                $rs1['Discount'] = "";
                $rs1['NetAmount'] = "";
                $rs1['PaidAmount'] = "";
                $rs1['DueAmount'] = "";
                $rs1['PatientName'] = "";
                $rs1['FirstName'] = "";
                $rs1['LastName'] = "";
                $rs1['Age'] = "";
                $rs1['Gender'] = "";
                $rs1['ReceiptDate'] = "";
                $rs1['DotorMobile'] = "";
                $rs1['PatientMobile'] = "";
            }

            //getting setting
            $rs2 = $this->settings->supplySettings();

            $clinic = $rs2['LabName'];
            $address = $rs2['Address'];
            $tagLine = $rs2['TagLine'];
            $email = $rs2['Email'];
            $website = !empty($rs2['Website']) ? $rs2['Website'] : "";
            $regdNo = !empty($rs2['RegdNo']) ? $rs2['RegdNo'] : "";
            $phone1 = !empty($rs2['PhoneNo1']) ? $rs2['PhoneNo1'] : "";
            $phone2 = !empty($rs2['PhoneNo2']) ? $rs2['PhoneNo2'] : "";
            $labNo = !empty($rs2['LabNo']) ? $rs2['LabNo'] : "";
            $pathologist = !empty($rs2['TechnicianName']) ? $rs2['TechnicianName'] : "";
            $qualification = !empty($rs2['TechnicianQualification']) ? $rs2['TechnicianQualification'] : "";
            $note1 = !empty($rs2['FooterNote1']) ? $rs2['FooterNote1'] : "";
            $note2 = !empty($rs2['FooterNote2']) ? $rs2['FooterNote2'] : "";
            $note3 = !empty($rs2['FooterNote3']) ? $rs2['FooterNote3'] : "";


            $group = [];

            foreach ($data as $val) {
                $group[$val['Category']][$val['TestName']][] = $val;
            }
            
           


            $result = [
                'group' => $group,
                'rs1' => $rs1,
                'rs2' => $rs2
            ];
        } else {
            redirect(base_url('app/receipt'));
            exit();
        }


        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'autoMarginPadding' => 1
        ]);
        $htmlHeader = '
                <table width="100%">
                <tr>
                <td width="45%" style="color:#0000BB; ">
                <p><img src="assets/img/logo.png" width="50" height="50"></p>
                <span style="font-weight: bold; font-size: 14pt;">' . $clinic . '</span>
                <p>' . $tagLine . '</p>
                <p>Email:' . $email . '</p>
                <p>Website: ' . $website . '</p>
                </td>
                <td width="18%"></td>
                <td width="35%" style="text-align: left;">
                <p>Regd No : ' . $regdNo . '</p>
                <p>(Under Clinical Establishment Act)</p>    
                <p>Phone:' . $phone1 . ',' . $phone2 . '<p/>
                <p>' . $address . '</p>
                <p>Lab No:1740</p>
                </td>
                </tr>
                </table>
                <hr style="color:black;box-shadow: none;border:none">';
        
        $htmlFooter = '
                <p style="text-align:right;">Dr.In Charge</p>            
                <p style="font-size:11px;margin:0;padding:0;text-align:center;">Electronically Varified Report,No Signature(s) Required</p>            
                <hr style="color:#000;box-shadow: none;border:none">            
                <table width="100%">
                <tr>
                <td colspan=4 style="text-align:center;">
                <p>' . $pathologist . '</p>
                <p>' . $qualification . '</p>
                </td>
                </tr>
                </table>
                <hr style="color:#000;box-shadow: none;border:none">
                <p style="font-size:11px;margin-top:0">* ' . $note1 . '</p>
                <p style="font-size:11px;margin-top:0">* ' . $note2 . '</p>
                <p style="font-size:11px;margin-top:0">* ' . $note3 . '</p>
                <table width="100%">
                <tr>
                <td width="33%">{DATE j-m-Y}</td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right;">SLR</td>
                </tr>
                </table>';

        if ($rs2['IsPrintReportHeader'] == 0) {
            $mpdf->SetHTMLHeader($htmlHeader);
            $mpdf->SetHTMLFooter($htmlFooter);
        } else {
            $mpdf->SetHTMLHeader('<br><br><br><br><br></br><br><hr>');
            $mpdf->SetHTMLFooter('<br><br><br><br><p>{PAGENO}/{nbpg}</p>');
        }

        $mpdf->setAutoBottomMargin = 'stretch';
        $html = $this->load->view('Report/ReportHtmlView', $result, TRUE);
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Report - Invoice");
        $mpdf->SetAuthor($clinic);
        $mpdf->SetWatermarkText($clinic);
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output($invoiceNo . '_report.pdf', 'I');
    }

    public function printSlip($salaryId) {
        if (!is_numeric($salaryId)) {
            redirect('app/salary/slip/print');
            exit();
        }

        //getting print details for salary slip
        $rs1 = $this->salary->supplySlipDetail($salaryId);


        //getting presents of employee
        $empId = $rs1['EmployeeID'];
        $year = date('Y', strtotime($rs1['SalaryMonth']));
        $month = date('m', strtotime($rs1['SalaryMonth']));
        $salaryMonth = $rs1['SalaryMonth'];
        $rs1['Present'] = $this->attendance->supplyEmpPresent($empId, $year, $month);
        $salaryMonth;
        //get scheme id
        $schemeId = $this->salary->provideSchemeId($empId, $salaryMonth);

        //getting setting
        $rs2 = $this->settings->supplySettings();



        //getting all allowances
        $wh1 = [
            'SalarySchemeID' => $schemeId,
            'AllowanceType' => 'A'
        ];

        $d1 = $this->salary->supplyAssignedSchemeAllowance($wh1);
        if (!empty($d1)) {
            $rs3 = $d1['result'];
        } else {
            $rs3 = [];
        }



        //getting all deduction 
        $wh2 = [
            'SalarySchemeID' => $schemeId,
            'AllowanceType' => 'D'
        ];
        $d2 = $this->salary->supplyAssignedSchemeDeduction($wh2);
        if (!empty($d2)) {
            $rs4 = $d2['result'];
        } else {
            $rs4 = [];
        }


        //getting all contribution
        $wh3 = [
            'SalarySchemeID' => $schemeId,
            'AllowanceType' => 'C'
        ];
        $d3 = $this->salary->supplyAssignedSchemeContribution($wh3);
        if (!empty($d3)) {
            $rs5 = $d3['result'];
        } else {
            $rs5 = [];
        }



        $clinic = $rs2['LabName'];
        $address = $rs2['Address'];
        $tagLine = $rs2['TagLine'];
        $email = $rs2['Email'];

        $formatedMonth = $this->appDateFormat($rs1['SalaryMonth'], $rs2['DateFormat']);
        $rs1['SalaryMonth'] = $formatedMonth;



        //getting the month year name
        $rs1['Month'] = date('F', strtotime($salaryMonth));
        $rs1['Year'] = date('Y', strtotime($salaryMonth));


        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'autoMarginPadding' => 1
        ]);

        $data = [
            'rs1' => $rs1,
            'rs2' => $rs2,
            'rs3' => $rs3,
            'rs4' => $rs4,
            'rs5' => $rs5
        ];


        $mpdf->SetHTMLHeader('');
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->SetHTMLFooter('Salary/Slip');
        $html = $this->load->view('ReportManager/SlipHtmlView', $data, true);
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Salary - Slip");
        $mpdf->SetAuthor($clinic);
        $mpdf->SetWatermarkText($clinic);
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output(random_int(99, 1000) . '_slip.pdf', 'I');
    }

}
