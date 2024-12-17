<footer class="main-footer">

    <strong>Copyright &copy; 2024-2025

    <!--<a href="https://riveyrainfotech.com/">Riveyra Infotech Pvt. Ltd. </a>.</strong> All rights reserved.-->

 </footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote.min.js"></script>

<!-- ./wrapper -->

<!-- Start Core Plugins

 =====================================================================-->



<!-- jquery-ui --> 

<script src="{{asset('public/backend/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}" type="text/javascript"></script>

<!-- Bootstrap -->

<script src="{{asset('public/backend/assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

<!-- lobipanel -->

<script src="{{asset('public/backend/assets/plugins/lobipanel/lobipanel.min.js')}}" type="text/javascript"></script>

<!-- Pace js -->

<script src="{{asset('public/backend/assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>

<!-- SlimScroll -->

<script src="{{asset('public/backend/assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>

<!-- FastClick -->

<script src="{{asset('public/backend/assets/plugins/fastclick/fastclick.min.js')}}" type="text/javascript"></script>

<!-- CRMadmin frame -->

<script src="{{asset('public/backend/assets/dist/js/custom.js')}}" type="text/javascript"></script>

<!-- End Core Plugins

 =====================================================================-->

<!-- Start Theme label Script

 =====================================================================-->

<!-- Dashboard js -->

<script src="{{asset('public/backend/assets/dist/js/dashboard.js')}}" type="text/javascript"></script>

<!-- table-export js -->

<script src="{{asset('public/backend/assets/plugins/table-export/tableExport.js')}}" type="text/javascript"></script>

<script src="{{asset('public/backend/assets/plugins/table-export/jquery.base64.js')}}" type="text/javascript"></script>

<script src="{{asset('public/backend/assets/plugins/table-export/html2canvas.js')}}" type="text/javascript"></script>

<script src="{{asset('public/backend/assets/plugins/table-export/sprintf.js')}}" type="text/javascript"></script>

<script src="{{asset('public/backend/assets/plugins/table-export/jspdf.js')}}" type="text/javascript"></script>

<script src="{{asset('public/backend/assets/plugins/table-export/base64.js')}}" type="text/javascript"></script>

<script src="{{asset('public/backend/assets/plugins/modals/classie.js')}}" type="text/javascript"></script>

<script src="{{asset('public/backend/assets/plugins/modals/modalEffects.js')}}" type="text/javascript"></script>

<script src="{{asset('public/backend/assets/dist/js/dashboard.js')}}" type="text/javascript"></script>

<!-- dataTables js -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.11/jspdf.plugin.autotable.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.11/jspdf.plugin.autotable.min.js"></script>

<script src="//unpkg.com/alpinejs" defer></script>

<script>

$(document).ready(function() {

    $('#productDescription').summernote({

        height: 200,

        placeholder: 'Enter blog description here...',

        toolbar: [

            ['style', ['style']],  // This will add the H1, H2, H3, paragraph options

            ['font', ['bold', 'underline', 'italic', 'clear']],

            ['fontsize', ['fontsize']],  // Allows selecting different font sizes

            ['fontname', ['fontname']],

            ['color', ['color']],

            ['para', ['ul', 'ol', 'paragraph', 'align']],

            ['table', ['table']],

            ['insert', ['link', 'picture', 'video']],

            ['view', ['fullscreen', 'codeview', 'help']]

        ],
        fontNames: ['Arial', 'Courier New', 'Times New Roman', 'Comic Sans MS', 'Montserrat', 'Roboto',],
        fontNamesIgnoreCheck: ['Noto Sans Hanunoo'],

        styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],  // Available heading options

        callbacks: {

            onImageUpload: function(files) {

                var editor = $(this);

                var file = files[0];

                

                // Create a file reader

                var reader = new FileReader();

                

                reader.onload = function(e) {

                    // Ask for alt text

                    var altText = prompt("Enter alt text for the image:");

                    

                    // Create image element with alt attribute

                    var imgNode = $('<img>').attr('src', e.target.result).attr('alt', altText);

                    

                    // Insert image into editor

                    editor.summernote('insertNode', imgNode[0]);

                };

                

                reader.readAsDataURL(file);

            }

        }

    });

});

</script>



<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>

CKEDITOR.replace( 'editor' );

</script>

<script>

CKEDITOR.replace( 'edit' );

</script>

<script>

CKEDITOR.replace( 'editing' );

</script>

    @if (session('successMessage'))

        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 10000)" x-show="show" class="alert alert-success "

            style="position: fixed; top: 10%; left: 55%; transform: translate(-50%, -50%); z-index:999999999999999; margin-top:-25px; width:30%;text-align:center;">

            <p>

                {{ session('successMessage') }}

            </p>

        </div>

    @endif



    @if (session('dangerMessage'))

        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 10000)" x-show="show" class="alert alert-danger"

            style="position: fixed; top: 10%; left: 55%; transform: translate(-50%, -50%); z-index:999999999999999; margin-top:-25px; width:30%;text-align:center;">

            <p>

                {{ session('dangerMessage') }}

            </p>

        </div>

    @endif



    @if (session('alertMessage'))

        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 10000)" x-show="show" class="alert alert-warning"

            style="position: fixed; top: 10%; left: 55%; transform: translate(-50%, -50%); z-index:999999999999999; margin-top:-25px; width:30%;text-align:center;">

            <p>

                {{ session('alertMessage') }}

            </p>

        </div>

    @endif

