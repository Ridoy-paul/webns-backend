<div>
    <div class="card p-1">
        <div class="card-body p-1 mb-5">
            <div class="d-flex justify-content-between">
                <h5><b>Visitors Report</b></h5>
                <div class="d-flex justify-content-between">
                    <input type="month" name="" id="month_input" value="{{ date("Y-m") }}" style="max-width: 200px;" class="form-control">
                    <button type="button" class="btn btn-primary ml-2" onclick="getMonthlyVisitors()">Search</button>
                </div>
            </div>

            <div id="monthlyReportData"></div>

            <div id="preloader" style="display: none; text-align: center; margin-top: 20px;">
                <h3><b>Loading...</b></h3>
            </div>
        </div>
    </div>
</div>

<script>
    var preloader = document.getElementById('preloader');
    var monthlyReportData = document.getElementById('monthlyReportData');

    function getMonthlyVisitors() {
        var month = document.getElementById('month_input').value;
        if(month == undefined || month == null || month == '') {
            errorMessage("select Month");
            return;
        }

        var url = "{{ route('admin.dashboard.visitors.report') }}?month=" + encodeURIComponent(month);
        preloader.style.display = 'block';
        monthlyReportData.innerHTML = '';

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                preloader.style.display = 'none';
                var response = JSON.parse(xhr.responseText);
                document.getElementById('monthlyReportData').innerHTML = response.reportHtml;
            } else {
                preloader.style.display = 'none';
            }
        };

        xhr.onerror = function () {
            preloader.style.display = 'none';
        };

        xhr.send();
    }

</script>
