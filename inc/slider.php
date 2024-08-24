<style>
    #slide {
        position: relative;
    }

    .form-chat {
        position: absolute;
        top: 20px;
        right: 65px;
        width: 420px;
        background-color: white;
        z-index: 700;
        /* position: fixed; */
        border-radius: 40px;
        border: 3px solid #0077C8;
        padding: 15px 40px;
    }

    .form-chat-title {
        font-size: 24px;
        font-weight: 700;
        color: #0077C8;
        text-align: center;
        text-transform: uppercase;
    }

    .form-chat-input {
        width: 100%;
        margin-top: 10px;
    }

    .form-chat-input input {
        outline: none;
        width: 100%;
        height: 40px;
        border-radius: 25px;
        font-size: 12px;
        padding: 5px 20px;
        font-weight: 600;
        color: #999;
        border: 2px solid #0077C8;
        font-style: italic;
    }

    .form-chat-input input:focus {
        border: 3px solid #0077C8;
        border-color: #0077C8;
    }

    .form-chat-input-button {
        width: 50%;
        border-radius: 25px;
        background-color: #0077C8;
        background: linear-gradient(270deg, #5EBEFF 0%, #0077C8 100%);

        color: white;
        font-size: 21px;
        font-weight: 700;
        text-align: center;
        text-transform: uppercase;
        padding: 0px 10px;
        cursor: pointer;
        border: none;
    }

    .form-chat-input-button:hover {
        transition: 0.5s;
        background: linear-gradient(270deg, #2a83bf 0%, #0077C8 100%);

    }

    .form-chat-input-button:focus {
        border: 0px solid rgba(1, 150, 154, 1);
        border-color: rgba(1, 150, 154, 1);
    }
</style>

<div style="height: 100%; margin-top:2px" id="slide">
    <div class="slide_show w-100">
        <div style="display: flex;" class="list_image">
            <img height="100%" width="100%" src="<?php echo $local ?>/images/banner/bg_carousell0.webp" alt="...">
            <img height="100%" width="100%" src="<?php echo $local ?>/images/banner/bg_carousell01.webp" alt="...">
            <img height="100%" width="100%" src="<?php echo $local ?>/images/banner/bg_carousell02.webp" alt="...">
        </div>
        <div class="btns">
            <div class="btn-left btn"><img width="40px" height="40px" src="<?php echo $local ?>/images/icons/icon_prev.webp" alt="..."></div>
            <div class="btn-right btn"><img width="40px" height="40px" src="<?php echo $local ?>/images/icons/icon_next.webp" alt="..."></i></div>
        </div>
        <div class="index-images">
            <div class="index-item index-item-0 active"></div>
            <div class="index-item index-item-1"></div>
            <div class="index-item index-item-2"></div>
        </div>
    </div>

    <div class="form-chat">
        <div  id="form-chatPc">
            <div class="form-chat-title">Đặt lịch khám</div>
            <div class="form-chat-input">
                <input name="hoten" type="text" placeholder="Họ tên">
            </div>
          
            <div class="form-chat-input">
            <input name="ngaysinh" type="number" placeholder="Nhập năm sinh" minlength="4" maxlength="4" min="1900" max="2100">
            </div>
            <div class="form-chat-input">
            <input name="sdt" type="number" placeholder="Số điện thoại">
            </div>
            <div class="form-chat-input">
            <input name="trieuchung" type="text" placeholder="Mô tả triệu chứng">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group form-chat-input">
                        <div class="datepicker date input-group">
                            <input name="ngaykham" type="text" placeholder="Ngày khám" class="form-control" id="fecha1">
                            <div style="height: 40px; margin-top: 0px; " class="input-group-append">
                                <span style="border-bottom: 2px;" class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-chat-input">
                    <input name="giokham" type="number" placeholder="Giờ khám">
                    </div>
                </div>
            </div>
            <div style="display: flex; align-items: center;justify-content: center; ">
                <button name="submit" class="form-chat-input-button">gửi</button>

            </div>
        </div>

    </div>
</div>

<div id="slide_mobile" style="border-bottom:2px solid white"  >
    <img height="auto" width="100%" src="<?php echo $local ?>/images/banner/mobile_banner.webp" alt="">
   
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
    document.querySelector('button[name="submit"]').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút submit

        let form = document.getElementById('form-chatPc');
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