
<div class="form-chat-mobile">
    <div id="form-chatMobile" class="form-chat-mobile-div">
        <div class="form-chat-mobile-title">Đặt lịch khám </div>
        <div class="form-chat-mobile-input">
        <input name="hoten" type="text" placeholder="Họ tên">
        </div>
        <div class="form-chat-mobile-input">
        <input name="ngaysinh" type="number" placeholder="Nhập năm sinh">
        </div>
        <div class="form-chat-mobile-input">
            <input name="sdt" type="number" placeholder="Số điện thoại">
        </div>
        <div class="form-chat-mobile-input">
        <input name="trieuchung" type="text" placeholder="Mô tả triệu chứng">
        </div>
        <div class="row">
                <div class="col-6">
                    <div class="form-group form-chat-mobile-input">
                        <div class="datepicker date input-group">
                            <input name="ngaykham" type="text" placeholder="Ngày khám" class="form-control" id="fecha1">
                            <div style="height: 35px; margin-top: 0px; " class="input-group-append">
                                <span style="border-bottom: 2px;" class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-chat-mobile-input">
                    <input name="giokham" type="number" placeholder="Giờ khám">
                    </div>
                </div>
            </div>
            <div style="display: flex; align-items: center;justify-content: center; ">
                <button name="LKMobile" class="form-chat-mobile-input-button">gửi</button>

            </div>
    </div>
</div>
<script>
    function formatPhoneNumber(phoneNumber) {
        let cleaned = ('' + phoneNumber).replace(/\D/g, '');
        let match = cleaned.match(/^(\d{4})(\d{3})(\d{3})$/);
        if (match) {
            return '(' + match[1] + ') ' + match[2] + '-' + match[3];
        }
        return null;
    }
    document.querySelector('button[name="LKMobile"]').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút submit

        let form = document.getElementById('form-chatMobile');
        let inputs = form.getElementsByTagName('input');
        let formData = {};

        for (let i = 0; i < inputs.length; i++) {
            let input = inputs[i];
            formData[input.name] = input.value;
        }
        formData['url'] = window.location.href;

        if (formData.giokham !== '' && formData.hoten !== '' && formData.ngaykham !== '' && formData.ngaysinh !== '' && formData.sdt !== '' && formData.trieuchung !== '') {
            if (formatPhoneNumber(formData.sdt)) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "https://phongkhamdakhoanhatviet.vn/api/khach-hang/create-khach-hang.php", true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {

                        let response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            for (let i = 0; i < inputs.length; i++) {
                                let input = inputs[i];
                                input.value = '';
                            }

                        } else {
                            toastr.error(response.message);
                        }
                    }
                };

                xhr.send(JSON.stringify(formData));
            } else {
                toastr.error("Số điện thoại không hợp lệ!");
            }

        } else {
            toastr.error("Tất cả các trường không được bỏ trống!");
        }


    });
</script>