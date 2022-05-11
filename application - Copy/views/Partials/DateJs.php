<script>
    $(function () {
        $("#DateOfBirth").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd",
            maxDate: 0,
            yearRange: "-100:+0" // last hundred years
        });

        $("#DateOfAnniversary").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#DateOfJoining").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        $("#Date").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#FromDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#ToDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        
        $("#InwardDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        
        $("#PurchaseDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        
        $("#ExFromYear").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        
        $("#ExToYear").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        
        $("#JoiningDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#AttendanceDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#SalaryDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#LeaveApplicationDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        
        
        $("#LeaveFromDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#AdvanceDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#LeaveToDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        
        $("#PaymentDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#SecurityDepositDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#VoucherDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        $("#ReportDate").datepicker({
            changeMonth: true,
            changeYear: true,
            selectedDate: new Date(),
            dateFormat: "yy-mm-dd"
        });

        $("#SalaryMonthYear").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: "yy-mm-dd",
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear,inst.selectedMonth,1));
            }
        });

        $("#AttendanceMonthYear").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: "yy-mm-dd",
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear,inst.selectedMonth,1));
            }
        });

    });
</script>