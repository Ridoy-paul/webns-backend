<div>
    <style>
        @page {
            margin-top: 5px;
            margin-bottom: 3px;
            margin-left: 25px;
            margin-right: 25px;
        }
        
        #pdfHeader {
            position: fixed; left: 0px; top: -10px; right: 0px; height: 130px;
            font-size: 20px !important;
            border-bottom: 1px solid #81d4fa;
        }
    
    
        #pdfFooter {
            position: fixed; left: 0px; bottom: 0px; right: 0px; height: 60px;
            font-size: 20px !important;
        }
    
        body {
            margin-top: 120px !important;
            margin-bottom: 55px !important;
            font-family: 'Arial, Helvetica, sans-serif';
        }
    
        li {
            list-style: none;
            float: left;
            overflow: hidden;
        }
    
        p {
            font-size: 13px;
        }
    
        .customar_info {
            width: 100%;
        }
    
        table {
            border-collapse: collapse;
            width: 100%;
        }
    
        td,
        th {
            border: 1px solid black;
            text-align: left;
            padding: 5px;
            font-size: 13px;
        }
    
        .invoiceIDandDate {
            text-align: right;
    
        }
    
        .clientInfo {
            background-color: red;
        }
        
        .pagenum:before {
            content: counter(page);
        }
    </style>
</div>