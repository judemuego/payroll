
<div id="compensation_tab" class="form-tab">
    <h3>COMPENSATION, TAXES AND BENEFITS TAB</h3>
    <br>
    <div class="row">
        <div class="col-12 mb-5">
            <h4>COMPENSATION AND TAXES</h4>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>ANNUAL SALARY</label>
                        <input type="number" class="form-control" id="annual_salary" name="annual_salary" placeholder="AMOUNT" value="0" onblur="scion.get.salary(this.value, 'annual', salary)">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>MONTHLY SALARY</label>
                        <input type="number" class="form-control" id="monthly_salary" name="monthly_salary" placeholder="AMOUNT" value="0" onblur="scion.get.salary(this.value, 'monthly', salary)">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>SEMI-MONTHLY SALARY</label>
                        <input type="number" class="form-control" id="semi_monthly_salary" name="semi_monthly_salary" placeholder="AMOUNT" value="0" onblur="scion.get.salary(this.value, 'semi_monthly', salary)">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>WEEKLY SALARY</label>
                        <input type="number" class="form-control" id="weekly_salary" name="weekly_salary" placeholder="AMOUNT" value="0" onblur="scion.get.salary(this.value, 'weekly', salary)">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>DAILY SALARY</label>
                        <input type="number" class="form-control" id="daily_salary" name="daily_salary" placeholder="AMOUNT" value="0" onblur="scion.get.salary(this.value, 'daily', salary)">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>HOURLY SALARY</label>
                        <input type="number" class="form-control" id="hourly_salary" name="hourly_salary" placeholder="AMOUNT" value="0" onblur="scion.get.salary(this.value, 'hourly', salary)">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>TAX</label>
                        <input type="number" class="form-control" id="tax" name="tax" placeholder="AMOUNT" value="0">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12">
            <h4>GOVERNMENT MANDATED BENEFITS</h4>
            <div class="row">
                <div class="col-3">
                    <select name="government_mandated_benefits" id="government_mandated_benefits" class="form-control"></select>
                </div>
                <div class="col-3">
                    <input type="text" id="government_mandated_benefits_amount" name="government_mandated_benefits_amount" class="form-control" placeholder="AMOUNT">
                    <br>
                </div>
                <div class="col-12">
                    <table id="government_mandated_benefits_table" class="table table-striped" style="width:100%"></table>
                </div>
            </div>
            <br>
            <br>
        </div>
        <div class="col-12">
            <h4>OTHER COMPANY BENEFITS</h4>
            <div class="row">
                <div class="col-3">
                    <select name="other_company_benefits" id="other_company_benefits" class="form-control"></select>
                </div>
                <div class="col-3">
                    <input type="number" id="other_company_benefits_amount" name="other_company_benefits_amount" class="form-control" placeholder="AMOUNT">
                    <br>
                </div>
                <div class="col-12">
                    <table id="other_company_benefits_amount_table" class="table table-striped" style="width:100%"></table>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>
</div>