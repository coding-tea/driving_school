<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>formation</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Inter:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- Include necessary libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: "Cairo", sans-serif;
        }

        body {
            padding: 40px;
        }

        #app {
            padding: 20px;
            width: 210mm;
            min-height: 297mm;
            /* margin: 0; */
        }

        #page1 {
            border: 5px solid #2C445D;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
        }

        #page1 .header {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        #page1 .header .names {
            text-align: center;
            /* border: 5px solid #2C445D; */
            font-size: 25px;
            font-weight: bold;
            /* width: 75%; */
            padding: 15px;
        }

        #page1 .header .image img {
            width: 100%;
        }

        #page1 .form {
            text-align: center;
            font-weight: bold;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #page1 .form .for {
            margin: 15px 0;
            padding: 15px;
            font-size: 20px;
            /* border: 5px solid #2C445D; */
            border-radius: 24px 4px;
        }

        #page1 .company {
            width: 100%;
            margin-bottom: 10px;
            border: 3px dotted #2C445D;
            border-radius: 15px;
            padding: 15px;
            text-align: right;
            font-size: 16px;
        }

        #page1 .candidat {
            width: 100%;
            margin-bottom: 10px;
            border-radius: 15px;
            padding: 15px;
            text-align: right;
            font-size: 16px;
            border-bottom: 1px dotted #2C445D;
        }

        #page1 .candidat table td,
        .director table td {
            text-align: right;
            color: #2C445D;
            font-weight: bold;

            font-size: 14px;
        }

        #page1 .director table {
            width: 70%;
        }

        #page1 .director table td {
            text-align: left;
            color: #2C445D;
            font-weight: bold;
            font-size: 14px;
            width: 80%;
        }

        #page1 .candidat table th,
        .director table th {
            width: 55%;
            font-size: 14px;
            text-align: right;
        }

        #page1 .roles {
            width: 100%;
            border-radius: 15px;
            padding: 15px;
            text-align: right;
            font-size: 16px;
        }
    </style>

</head>

<body>

    <div style="text-align: center">
        {{-- <button class="btn btn-print" style="text-decoration: none;color: #000;font-style: italic;"
            onclick="printCV()">print</button> --}}
        <button class="btn btn-download"
            style="text-decoration: none;color: #fff;background-color: #2C445D; font-style: italic; padding: 8px 20px; border-radius: 10px;font-weight: bold;  letter-spacing: 1px; font-size: 20px; cursor: pointer;"
            onclick="downloadPDF()">download</button>
    </div>


    <div id="app">

        <div id="page1">

            <div class="header">
                <div class="names">
                    <div style="color: #2C445D;">
                        شهادة نهاية التكوين عدد
                        <span style="color: #2C445D;">
                            33/2024
                        </span>
                    </div>
                </div>
            </div>

            <div class="company">
                <div>
                    <b>SOCIETE YMASS AUTO sarlau</b> مؤسسة تعليم السياقة
                </div>

                <div>
                    رقم القيد في السجل الوطني الخاص بمؤسسات تعليم السياقة : <b>6622</b>
                </div>

                <div>
                    مقرها الاجتماعي : الحي الجديد - عين الشكاك المركز
                </div>

                <div>
                    <span>
                        رقم القيد في سجل الضريبة المهنية : <b>16600208</b>
                    </span>
                    رقم القيد في السجل التجاري : </b>3445</b>
                </div>

                <div>
                    <b>0535.66.51.71</b> :الهاتف: <b>0535.66.51.71 - 0666.88.61.21</b> الفاكس
                </div>

                <div>
                    <b>ymass.auto@gmail.com</b> البريد
                </div>

            </div>

            <div class="director" style="width: 100%; border-bottom: 1px dotted #2C445D;  border-radius: 15px;">
                <h5 style="color: #2C445D; font-size: 15px;font-weight: bold;text-align: center;">
                    معلومات عن المدير
                </h5>

                <div style="display: flex;justify-content: center;align-items: center;margin-bottom: 10px;">
                    <table>
                        <tr>
                            <td>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div> ABDELKRIM </div>
                                    <div style="text-align: right;">
                                        عبد الكريم
                                    </div>
                                </div>
                            </td>
                            <Th>
                                الاسم الشخصي
                            </Th>
                        </tr>

                        <tr>
                            <td>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; width: 100%">
                                    <div style="text-align: left;"> LBOUHADDIOUI </div>
                                    <div style="text-align: right;">
                                        البوحديوي
                                    </div>
                                </div>
                            </td>
                            <Th>
                                الاسم العائلي
                            </Th>
                        </tr>

                        <tr>
                            <td>
                                <div style="text-align: right;">
                                    دوار ايت حساين - عين شكاك - صفرو
                                </div>
                            </td>
                            <Th>
                                العنوان
                            </Th>
                        </tr>

                        <tr>
                            <td>
                                <div style="text-align: right;">
                                    0666886121
                                </div>
                            </td>
                            <Th>
                                الهاتف
                            </Th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="candidat">
                <h5 style="color: #2C445D; font-size: 15px;font-weight: bold;text-align: center;">
                    المرشح
                </h5>

                <table style="text-align: right; border: none; width: 100%; font-size: 16px;">
                    <tr>
                        <td>
                            <div id="name" style="display: none;">{{ $data->name }}</div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div> {{ $data->name }} </div>
                                <div style="text-align: right;"> {{ $data->name_ar }} </div>
                            </div>
                        </td>
                        <th>
                            <div style="display: flex; text-align: right; justify-content: flex-end">
                                <div>(ة)</div>
                                <div>
                                    اشهد ان
                                    ألسيد
                                </div>
                            </div>
                        </th>
                    </tr>

                    <tr>
                        <td> {{ $data->cin }} </td>
                        <th>بطاقة تعريفه )ا( الوطنية رقم</th>
                    </tr>

                    <tr>
                        <td> {{ $data->reference }} </td>
                        <th>رقم تسجيل المرشج)ة( الممنوح من طرف الادارة</th>
                    </tr>

                    <tr>
                        <td> {{ $data->signin_date }} </td>
                        <th>
                            بناء على عقد التكوين الموقع بين الطرفين
                        </th>
                    </tr>

                    <tr>
                        <th colspan="2">
                            تلقى(تلقت) بهده المؤسسة دروسا نظرية و نطبيقية في تعليم سياقو المركبات من صنف
                            " ب "
                            بما مجموعه 20 ساعة تكوين نظري و 20 ساعة تكوين تطبيقي طبعا للبرنامج الوطني لتعليم السياقة
                        </th>
                    </tr>
                </table>

            </div>

            <div class="signatures" style="width:100%; margin-top: 20px; text-align: center; font-size: 14px;">
                <div>
                    وقد اشرف على التكوين النظري المدرب الوارد اسمه بهده
                </div>

                <strong>
                    <div>
                        اسم المدير سعيد بوعلي الحامل برخصة مدرب تعليم سياقة عدد 9735
                    </div>
                </strong>

                <div>
                    و اشرف على التكوين التطبيقي المدرب الوارد اسمه بعده
                </div>

                <strong>
                    <div>
                        اسم المدير سعيد بوعلي الحامل برخصة مدرب تعليم سياقة عدد 9735
                    </div>
                </strong>

                <div>
                    كما تلقى (نلقت)
                    تكوينه )ة(
                    بواسطة المركبة من صنف
                    "ب"
                    المسجلة تحث رقم
                    10997 - ا - 18
                </div>

                <div style="text-align: center; margin-top: 3px;">
                    حرر بتاريخ
                </div>

                <div id="signature"
                    style="width:100% ;display: flex; justify-content: space-between; align-items: center; margin-top: 5px; font-size: 14px; text-align: right; padding: 0 20px">
                    <div style="height: 150px; width: 50%;">
                        <div style="color: #2C445D; font-weight: bold;">
                            توقيع المرشح أو ولي أمره مصادق عليه
                        </div>
                    </div>
                    <div style="height: 150px; width: 50%;">
                        <div style="color: #2C445D; font-weight: bold;">
                            توقيع المدير وخاتم المؤسسة
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        const {
            jsPDF
        } = window.jspdf;

        function downloadPDF() {
            // Create a new jsPDF instance with A4 dimensions
            const docPDF = new jsPDF({
                unit: 'mm',
                format: 'a4'
            });

            // Get the CV template content
            const cvContent = document.querySelector("#app");

            // Convert CV content to PDF
            html2canvas(cvContent, {
                scale: 2
            }).then(canvas => {
                const imgWidth = 210; // Width of A4 in mm
                const imgHeight = canvas.height * imgWidth / canvas.width;

                // Adjust the height to fit within A4 page size (297 mm)
                const pageHeight = 297; // A4 height in mm
                let heightLeft = imgHeight;
                let position = 0;

                // Add image data to PDF
                while (heightLeft > 0) {
                    docPDF.addImage(canvas.toDataURL('image/png'), 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                    position -= pageHeight;
                    if (heightLeft > 0) docPDF.addPage();
                }

                const pdfname = document.querySelector('#name').innerHTML + " end " + ".pdf";
                // Save PDF
                docPDF.save(pdfname);
            });
        }
    </script>

</body>

</html>
