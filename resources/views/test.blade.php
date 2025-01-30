{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Divs</title>
    <style>
        /* Basic styling for the print layout */
        @media print {
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                width: 100%;
                height: 100%;
            }

            /* Hide the sidebar in print */
            .sidebar {
                display: none;
            }

            .print-content {
                page-break-before: always;
                /* Each div will start on a new page */
            }

            .print-content:first-child {
                page-break-before: auto;
                /* First content doesn't need page break before */
            }

            /* Header and Footer styling for printing */
            .header,
            .footer {
                text-align: center;
                font-size: 12px;
                position: fixed;
                width: 100%;
                left: 0;
                right: 0;
                background-color: #fff;
                z-index: 100;
            }

            .header {
                top: 0;
                height: 50px;
                /* Adjust as needed */
                padding-top: 10px;
                border-bottom: 1px solid #000;
            }

            .footer {
                bottom: 0;
                height: 30px;
                /* Adjust as needed */
                padding-bottom: 5px;
                border-top: 1px solid #000;
            }

            /* Prevent page breaks inside divs */
            .no-break {
                page-break-inside: avoid;
            }

            /* To ensure that header and footer do not overlap content */
            body {
                padding-top: 60px;
                /* Adjust based on the height of your header */
                padding-bottom: 40px;
                /* Adjust based on the height of your footer */
            }

            /* Ensure content starts after the header */
            .print-content {
                padding-top: 20px;
            }

            /* Hide the print button */
            .no-print {
                display: none;
            }

            /* Ensure content starts after the header */
            .content {
                margin-left: 0;
                padding: 10px;
                width: 100%;
                page-break-before: always;
            }
        }



        /* -------------------------------------------- */
        /* The side navigation menu */
        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #f1f1f1;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        /* Sidebar links */
        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }

        /* Active/current link */
        .sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }

        /* Links on mouse-over */
        .sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        /* Page content. The value of the margin-left property should match the value of the sidebar's width property */
        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }

        /* On screens that are less than 700px wide, make the sidebar into a topbar */
        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar a {
                float: left;
            }

            div.content {
                margin-left: 0;
            }
        }

        /* On screens that are less than 400px, display the bar vertically, instead of horizontally */
        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h1>Header Section</h1>
    </div>

    <!-- The sidebar (hidden on print) -->
    <div class="sidebar">
        <a class="active" href="#home">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
    </div>

    <!-- Page content -->
    <div class="content">

        <!-- Content to be printed -->
        <div class="print-content no-break" id="content1">
            <h2>Section 1</h2>
            @for($i=1; $i<100; $i++) <p>This is the content for the first section. It will appear on the first page.</p>
                @endfor
        </div>

        <div class="print-content no-break" id="content2">
            <h2>Section 2</h2>
            <p>This is the content for the second section. It will appear on the second page.</p>
        </div>

        <div class="print-content no-break" id="content3">
            <h2>Section 3</h2>
            <p>This is the content for the third section. It will appear on the third page.</p>
        </div>

        <!-- Print Button -->
        <button class="no-print tex-center" onclick="window.print()">Print</button>

    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Footer Section</p>
    </div>

</body>

</html> --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Div Example</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        /* General styles for the divs */
        #portraitDiv,
        #landscapeDiv {
            border: 2px solid black;
            margin: 20px;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* Portrait-specific styling */
        #portraitDiv {
            background-color: #f0f8ff;
        }

        /* Landscape-specific styling */
        #landscapeDiv {
            background-color: #ffe4e1;
        }
    </style>

</head>

<body>
    <div id="portraitDiv">
        <h2>Portrait Div</h2>
        <p>This content will be printed in portrait mode.</p>

        <div>jksdsdjsd
            <br>
            1<br> 2323
        </div>
        <button onclick="printPortrait()">Print Portrait Div</button>
    </div>

    <div id="landscapeDiv">
        <h2>Landscape Div</h2>
        <p>This content will be printed in landscape mode.</p>
        <button onclick="printLandscape()">Print Landscape Div</button>
    </div>

    <script src="script.js"></script>

    <script>
        function printPortrait() {
  const printContent = document.getElementById('portraitDiv');
  const printWindow = window.open('', '_blank');
  printWindow.document.write('<html><head><title>Print Portrait</title>');
  printWindow.document.write('<link rel="stylesheet" href="styles.css">');
  printWindow.document.write('</head><body>');
  printWindow.document.write(printContent.outerHTML);
  printWindow.document.write('</body></html>');
  printWindow.document.close();
  printWindow.focus();
  printWindow.print();
  printWindow.close();
}

function printLandscape() {
  const printContent = document.getElementById('landscapeDiv');
  const printWindow = window.open('', '_blank');
  printWindow.document.write('<html><head><title>Print Landscape</title>');
  printWindow.document.write('<style>@page { size: landscape; }</style>');
  printWindow.document.write('<link rel="stylesheet" href="styles.css">');
  printWindow.document.write('</head><body>');
  printWindow.document.write(printContent.outerHTML);
  printWindow.document.write('</body></html>');
  printWindow.document.close();
  printWindow.focus();
  printWindow.print();
  printWindow.close();
}

    </script>
</body>

</html>