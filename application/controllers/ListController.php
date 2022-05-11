<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ListController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TestModel', 'test');
        $this->load->model('PatientModel', 'patient');
        $this->load->model('ReceiptModel', 'receipt');
        $this->load->model('ReportModel', 'report');
        $this->load->model('SettingsModel', 'settings');
        $this->load->model('DoctorModel', 'doctor');
    }

    public function printDoctorList() {

        $data = [
            'doctors' => $this->doctor->supplyDoctors()
        ];

        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'autoMarginPadding' => 1
        ]);


        $mpdf->SetHTMLHeader();
        $mpdf->SetHTMLFooter();



        $html = $this->load->view('Print/DoctorListView', $data, TRUE);
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Doctor List");
        $mpdf->SetAuthor('');
        $mpdf->SetWatermarkText('');
        $mpdf->showWatermarkText = false;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);

        $mpdf->Output(strtotime(date('Y-m-d')) . '.pdf', 'I');
    }

    public function printPatientList() {

        $data = [
            'patients' => $this->patient->supplyPatients()
        ];

        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'autoMarginPadding' => 1
        ]);


        $mpdf->SetHTMLHeader();
        $mpdf->SetHTMLFooter();



        $html = $this->load->view('Print/PatientListView', $data, TRUE);
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Doctor List");
        $mpdf->SetAuthor('');
        $mpdf->SetWatermarkText('');
        $mpdf->showWatermarkText = false;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);

        $mpdf->Output(strtotime(date('Y-m-d')) . '.pdf', 'I');
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
                $rs1['DoctorName'] = "";
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
        $html = '
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

        $mpdf->SetHTMLHeader($html);
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->SetHTMLFooter('
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
</table>');
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

}
