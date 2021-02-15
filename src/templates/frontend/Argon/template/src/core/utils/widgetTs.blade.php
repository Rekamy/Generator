
import Swal, { SweetAlertOptions, SweetAlertIcon } from 'sweetalert2';;
import Cropper from 'cropperjs';
import toastr from 'toastr';

class WidgetService {
    // public Swal!: Swal
    alert (title: string, content: string, icon: any = "info") {
        return Swal.fire({
            title: title,
            text: content,
            icon: icon
        });
    }
    alertSuccess (title: string, subtitle?: string) {
        return Swal.fire(title, subtitle ?? '', 'success')
    }

    alertError (error: any) {
        if (!process.env.production) console.log(error)
        return Swal.fire(
            'Opps!',
            error.message,
            'error'
        );
    }
    confirm (title: string, subtitle?: string, action: boolean = false, icon: SweetAlertIcon = 'warning') {
        const config: SweetAlertOptions = {
            title: title,
            text: subtitle,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed it!'
        };
        Swal.fire(config)
    }
    alertDelete () {
        return Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed it!'
        })
    }
    async loading (title = 'Loading...') {
        Swal.fire({
            title: title,
        })

        return Swal;
    }

    toast (message: string, icon: any = 'info', timeout = 3000) {
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "timeOut": timeout
        }
        const toast: any = toastr;
        toast[icon](message)
    }


    presentAlertConfirm(title: string, message: string) {
        return new Promise((resolve: any, reject: any) => {
            Swal.fire({
                title: title,
                icon: "warning",
                html: message,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    resolve(true);
                } 

                resolve(false);

            })
        });
    }

    async cropper(img) {
        return new Promise((resolve: any, reject: any) => {

            const getRoundedCanvas = (sourceCanvas) => {
                var canvas: any = document.createElement('canvas');
                var context: any = canvas.getContext('2d');
                var width = sourceCanvas.width;
                var height = sourceCanvas.height;

                canvas.width = width;
                canvas.height = height;
                context.imageSmoothingEnabled = true;
                context.drawImage(sourceCanvas, 0, 0, width, height);
                context.globalCompositeOperation = 'destination-in';
                context.beginPath();
                context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
                context.fill();
                return canvas;

            }

            const urltoFile = (url, filename, mimeType) => {
                return (fetch(url)
                    .then(function (res) { return res.arrayBuffer(); })
                    .then(function (buf) { return new File([buf], filename, { type: mimeType }); })
                );
            }

            let image: any;
            let preview: any;
            Swal.fire({
                html: `
                    <div class="row">
                        <div class="col-xs-12" style="text-align:center">
                            <label>Crop Image</label>
                            <div style="width: 400px;height: 400px;">
                                <p style="width: 400px;height: 400px;text-align:center">
                                    <img src="${img}" id="cropperView" />
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <label>Preview Image</label>
                            <p style="width: 200px;height: 200px;text-align:center">
                                <img id="imgPreview" style="width: 200px;height: 200px;" />
                            </p>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                cancelButtonText: "Cancel",
                confirmButtonText: 'Confirm',
                didOpen: () => {

                    image = document.getElementById("cropperView");
                    preview = document.getElementById("imgPreview")
                    const cropper = new Cropper(image, {
                        zoomable: true,
                        scalable: false,
                        aspectRatio: 1,
                        viewMode: 1,
                        crop: () => {
                            try {
                                const canvas = cropper.getCroppedCanvas();
                                const roundedCanvas = getRoundedCanvas(canvas);;
                                preview.src = roundedCanvas.toDataURL("image/png");
                            } catch (e) {
                                console.log(e);
                            }
                        }
                    });
                }
            }).then((result: any) => {
                urltoFile(preview.src, 'cropped.png', 'image/png')
                    .then(function (file) {
                        const files: any = new ClipboardEvent("").clipboardData || new DataTransfer();
                        files.items.add(file);
                        resolve({
                            files: files.files, value: preview.src, confirm: result.isConfirmed
                        })
                    });
            })
        });
    }
}
const widget = new WidgetService();
export { widget, WidgetService };