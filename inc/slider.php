<style>
    #slide {
        position: relative;
    }

    .form-chat {
        position: absolute;
        top: 20px;
        right: 65px;
        min-height: 400px;
        width: 575px;
        background-color: white;
        z-index: 700;
        /* position: fixed; */
        border-radius: 40px;
        border: 3px solid #166B85;
        padding: 15px 40px;
    }

    .form-chat-title {
        font-size: 40px;
        font-weight: 700;
        color: #166B85;
        text-align: center;
        text-transform: uppercase;
    }

    .form-chat-input {
        width: 100%;
        margin-top: 15px;
    }

    .form-chat-input input {
        outline: none;
        width: 100%;
        height: 50px;
        border-radius: 25px;
        font-size: 20px;
        padding: 5px 20px;
        font-weight: 600;
        color: #999;
        border: 2px solid #166B85;
        font-style: italic;
    }

    .form-chat-input input:focus {
        border: 3px solid #166B85;
        border-color: #166B85;
    }

    .form-chat-input-button {
        margin-top: 15px;
        width: 80%;
        border-radius: 25px;
        background-color: #166B85;
        background-image: linear-gradient(to right, #166B85, #209dc3);
        color: white;
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        text-transform: uppercase;
        padding: 0px 10px;
        cursor: pointer;
        border: none;
    }

    .form-chat-input-button:hover {
        transition: 0.5s;
        background-image: linear-gradient(to right, #0e4758, #209dc3);
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
        <form action="" method="post">
            <div class="form-chat-title">Đặt lịch khám</div>
            <div class="form-chat-input">
                <input type="text" placeholder="Họ tên">
            </div>
            <!-- <div class="form-group form-chat-input">
                <div class="datepicker date input-group">
                    <input type="text" placeholder="Ngày sinh" class="form-control" id="fecha1">
                    <div style="height: 50px;" class="input-group-append">
                        <span style="border-bottom: 2px solid transparent;" class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div> -->
            <div class="form-chat-input">
                <input type="text" placeholder="Ngày tháng năm sinh">
            </div>
            <div class="form-chat-input">
                <input type="text" placeholder="Số điện thoại">
            </div>
            <div class="form-chat-input">
                <input type="text" placeholder="Mô tả triệu chứng">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group form-chat-input">
                        <div class="datepicker date input-group">
                            <input type="text" placeholder="Ngày khám" class="form-control" id="fecha1">
                            <div style="height: 50px; margin-top: 0px; " class="input-group-append">
                                <span style="border-bottom: 2px;" class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-chat-input">
                        <input type="text" placeholder="Giờ khám">
                    </div>
                </div>
            </div>
            <div style="display: flex; align-items: center;justify-content: center; ">
                <button class="form-chat-input-button">gửi</button>

            </div>
        </form>

    </div>
</div>