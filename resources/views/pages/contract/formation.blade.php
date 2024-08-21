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

        #page1,
        #page2 {
            width: 100%;
            max-height: 297mm;
            border: 5px solid #2C445D;
            border-radius: 10px;
            margin-bottom: 40px;
            font-size: 15px;
            padding: 10px;
            text-align: right;
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
            font-size: 20px;
            font-weight: bold;
            /* width: 75%; */
            /* padding: 20px; */
        }

        /*
        #page1 .header .image {
            width: 25%
        } */

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
            border: 5px solid #2C445D;
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

        #page1 .candidat table td {
            text-align: right;
            color: #2C445D;
            font-weight: bold;
            /* width: 60%; */
            font-size: 16px;
        }

        #page1 .candidat table th {
            width: 55%;
            font-size: 16px;
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
        <button class="btn btn-download"
            style="text-decoration: none;color: #fff;background-color: #2C445D; font-style: italic; padding: 8px 20px; border-radius: 10px;font-weight: bold;  letter-spacing: 1px; font-size: 20px; cursor: pointer;"
            onclick="downloadPDF()">download</button>
    </div>


    <div id="app">

        <div id="page1">

            <div class="header">
                {{-- <div class="image">
                    <img src="{{ asset('assets/images/car.png') }}" alt="car">
                </div> --}}
                <div class="names">
                    <div style="color: #2C445D;"> مؤسسة يماس لتعليم السياقة</div>
                    <div style="color: #2C445D;"> SOCIETE YMASS AUTO sarl.au</div>
                    {{-- <div>6622</div> --}}
                </div>
            </div>

            <div class="form">
                <div class="for">
                    <div>عقد تكوين عدد : <b style="color: #2C445D;">2024/34</b></div>
                    <div> بتاريخ : <b style="color: #2C445D;">{{ $data->signin_date }}</b> </div>
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
                    مقرها الاجتماعي : الحي الجديد - <b>عين الشكاك المركز</b>
                </div>

                <div>
                    رقم القيد في سجل الضريبة المهنية : <b>16600208</b>
                </div>

                <div>
                    رقم القيد في السجل التجاري : <b>3445</b>
                </div>

                <div>
                    المدينة : <b>عين الشكاك</b>
                </div>

                <div>
                    <b>0535.66.51.71</b> :الهاتف: <b>0535.66.51.71 - 0666.88.61.21</b> الفاكس
                </div>

                <div>
                    <b>ymass.auto@gmail.com</b> البريد
                </div>

                <div style="text-align: left">
                    المسماة المؤسسة
                </div>



            </div>

            <div class="candidat">

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
                                <div>ألسيد</div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td> {{ $data->cin }} </td>
                        <th>بطاقة تعريفه )ا( الوطنية الالكنرونية رقم</th>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <div> {{ $data->birthday }} </div>
                                <div> {{ $data->birth_city }} </div>
                            </div>
                        </td>
                        <th>المزداد)ة( ب</th>
                    </tr>
                    <tr>
                        <td> {{ $data->adress }} </td>
                        <th>القاطن)ة( ب</th>
                    </tr>
                    <tr>
                        <td> {{ $data->reference }} </td>
                        <th>رقم تسجيل المرشج)ة( الممنوح من طرف الادارة</th>
                    </tr>
                </table>

            </div>

            <div class="roles">

                <div style="text-align: center; text-decoration: underline; color: #2C445D; font-weight: bold;">اتفق
                    الطرفان على ما يلي</div>

                <div style="text-decoration: underline;color: #2C445D; font-weight: bold;">المادة 1 : موضوع العقد</div>

                <div>
                    يهدف هذا العقد إلى تكوين المرشح وتمكينه من اكتساب المعارف والمهارات الضرورية اللازمة التي تمكنه من
                    سياقة
                    مركبة تتطلب <br>


                    <span>، طبقا للبرامج المحددة من طرف الإدارة.</span>
                    <b>"B"</b>
                    <span>قيادتها رخصة السياقة من صنف </span>
                    <br>

                    كما يحدد حقوق وواجبات كلا الطرفين مع مراعاة القوانين والأنظمة الجاري بها العمل في هذا الشأن
                </div>

            </div>
        </div>

        <div id="page2">
            <div class="page2">
                <h3 style="text-decoration: underline;color: #2C445D; font-weight: bold;"> المادة 2 : مدة العقد</h3>

                <p> يمتد هذا العقد لمدة سنة أشهر ابتداء من تاريخ توقيعه، ويمكن تمديده، في حالة الاتفاق بين الطرفين، لمدة
                    لا
                    تتعدى ثلاثة أشهر. </p>

                <h3 style="text-decoration: underline;color: #2C445D; font-weight: bold;">المادة 3 : التزامات المؤسسة
                </h3>

                <p>
                    تلتزم المؤسسة بتكوين المرشح طبقا للبرنامج الوطني لتعليم السياقة
                    <br>
                    تلفن الدروس النظرية والتطبيقية، تحت إشراف مدير المؤسسة من طرف مدرب أو مدربي تعليم السياقة مرخص لهم،
                    تشغلهم
                    <br>
                    المؤسسة لهذا الغرض وبواسطة مركبات لتعليم السياقة في ملكيتها.
                    <br>
                    للتزم المؤسسة بتوفير المركبة التي يتم بواسطتها إجراء الاختبار التطبيقي.
                    <br>
                    لا يمكن الشروع في التكوين النظري إلا بعد حصول المرشح على رقم التسجيل الممنوح له من طرف الإدارة.
                    تلتزم
                    المؤسسة بإخبار المرشح فورا بحصوله على هذا الرقم، كما تلتزم بتسليم المرشح شهادة نهاية التكوين فور
                    إنهائه
                    له.
                    <br>
                    تحتفظ المؤسسة بحق إرجاء دروس التكوين إلى تاريخ لاحق في حالة قوة قاهرة وفي كل الحالات التي تكون فيها
                    السلامة غير متوفرة. بعد استفادة المرشح من عدد ساعات التكوين النظري والتطبيقي المتفق عليها، تلتزم
                    المؤسسة
                    بتقديمه لاجتياز الامتحانات النيل
                    <br>
                    رخصة السياقة في حدود المقاعد الممنوحة من طرف الإدارة

                </p>

                <h3 style="text-decoration: underline;color: #2C445D; font-weight: bold;"> المادة 4 : التزامات المرشح
                </h3>

                <p>
                    إذا توقف المرشح عن التكوين، سواء بصفة مؤقتة أو نهائية، وكيفما كانت الأسباب يلتزم بإخبار المؤسسة
                    كتابيا.
                    <br>
                    في حالة التوقف لأكثر من ثلاثة (3) أشهر متتالية، يحق للمؤسسة مطالبة المرشح بأداء مبالغ الخدمات
                    المتبقية،
                    وغير المؤداة. إذا انقطع المرشح عن التكوين لمدة تفوق سنة (6) أشهر يعتبر متخليا من التكوين ولا يحق له
                    أن
                    يسترجع ما دفعه من أجله.
                    <br>
                    إذا تخلى المرشح من التكوين لسبب يعود له ، يؤدي التعريفة كاملة . في حالة عدم النجاح في الامتحان،
                    يلتزم
                    المرشح بأداء مصاريف إعادة تكوينه وفقا لنفس التعريفة
                </p>


                <h3 style="text-decoration: underline;color: #2C445D; font-weight: bold;">المادة 6 : تعريفة التكوين</h3>

                <p>
                    تحتسب التعريفة الإجمالية للتكوين على أساس تعريفة مناعة التكوين النظري والتطبيقي المحددة في المادة 1
                    من القرار الذي يحدد

                    الى الإدارة لا تتحمل مسوري ) مضمون الوثيقة

                    تعريفة ساعة التكوين النظري والتطبيقي.

                    المادة 7 : كيفيات الأداء

                    تسلم للمرشح فاتورة تحدد المبالغ المدفوعة للمؤسسة، وتكون هذه الفاتورة مؤرخة وموقعة من طرف صاحب
                    المؤسسة تحمل هذه

                    الفاتورة اسم وطابع المؤسسة، وفقا للتشريعات الجاري بها العمل. في حالة الاتفاق بين الطرفين، يمكن أداء
                    مبلغ التكوين على أقساط.
                </p>
            </div>

            <div class="signature">
                <strong>
                    <div style="text-align: center;">
                        عقد محرر في ثلاثة نظائر أصلية.
                        في عين الشكاك بتاريخ {{ $data->signin_date }}
                    </div>
                </strong>
            </div>

            <div id="signature"
                style="display: flex; justify-content: space-between; align-items: center; margin-top: 5px;">
                <div class="candidat"style="height: 150px; width: 50%;">
                    <div style="color: #2C445D; font-weight: bold;">
                        توقيع المرشح أو ولي أمره مصادق عليه
                    </div>
                    <p>
                        يشهد بصحة الامضاء الدي وضعه
                        <br>
                        السيد
                        <strong>
                        {{ $data->name_ar }}
                        </strong>
                        <br>
                        بعد اثبات هويته من طرفنا تحث عدد
                        <br>
                        جماعة عين شكاك في
                    </p>
                </div>
                <div class="office" style="height: 150px; width: 50%;">
                    <div style="color: #2C445D; font-weight: bold;">توقيع المدير وخاتم المؤسسة</div>
                </div>
            </div>

            <div style="text-align: center; letter-spacing: 3px; margin-top: 5px;">
                Tel/Fax: 0535665171*GSM: 0666886121ICE: 002927492000009*** RC :3445
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

                const pdfname = document.querySelector('#name').innerHTML+ " start" + ".pdf";
                // Save PDF
                docPDF.save(pdfname);
            });
        }
    </script>

</body>

</html>
