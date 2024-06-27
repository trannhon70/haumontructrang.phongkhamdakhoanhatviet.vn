<style>
    .post_title {
        margin-top: 20px;
        color: white;
        font-size: 23px;
        font-weight: 700;
        text-transform: uppercase;
        background-color: #008DBA;
        padding: 10px 15px;
    }


    .chinh-sua {
        background-color: #e1b564;
        color: white;
        font-size: 18px;
        font-weight: 500;
        padding: 2px 10px;
        border-radius: 7px;
    }

    .chinh-sua:hover {
        background-color: #d79f39;
        transition: 1s;
    }

    .blurred {
        filter: blur(5px);
        transition: filter 0.5s;
    }

    .view {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px 20px;
        background-color: #666;
        color: white;
        border: none;
        cursor: pointer;
        width: 600px;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .view_button {
        position: absolute;
        top: 63%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px 20px;
        background-color: white;
        color: #999;
        border: none;
        cursor: pointer;
        z-index: 1000;
        border-radius: 10px;
        border: none;
    }

    .hidden {
        display: none;
    }

    .image-container {
        position: relative;
        display: inline-block;
    }

    .hiden_img {
        /* margin-bottom: 10px; */
        position: relative;
    }
</style>
<?php if (Session::get('role') === 'admin') {

?>
    <a class="chinh-sua" href="<?php echo $local ?>/admin/bai-viet-edit.php?edit=<?php echo $get_post_detail['id'] ?>"><i style="font-size: 19px;" class='bx bxs-pencil'></i> chỉnh sửa</a>
<?php } ?>

<h1 class="post_title">
    <?php echo $get_post_detail['tieu_de'] ?>

</h1>
<div id="banner_km_mobile" style="width: 100%;" >
        <img width="100%" src="<?php echo $local ?>/images/logo_mobile/bg_mobile_km.gif" alt="">
    </div>
<hr>
<div id="bai-viet" class="">

    <?php echo htmlspecialchars_decode($get_post_detail['content']); ?>

</div>
<div class="bai-viet-footer" >
Nội dung bài viết cung cấp nhằm mục đích tham khảo thêm kiến thức y tế, một số nội dung có thể không thuộc nghiệp vụ của phòng khám chúng tôi, Hiệu quả của việc hỗ trợ điều trị phụ thuộc vào cơ địa của mỗi người. Cần biết thông tin liên hệ để được tư vấn trực tuyến miễn phí. <a href="#">[TƯ VẤN TRỰC TUYẾN]</a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const shockElements = document.querySelectorAll('.shock_img');
        shockElements.forEach(shockElement => {

            shockElement.classList = 'hiden_img'
            const viewdiv = document.createElement('div');
            viewdiv.id = 'viewdiv';
            viewdiv.className = 'view';
            viewdiv.textContent = 'Hình ảnh có nội dung gây shock !! cân nhất trước khi xem';

            const viewbutton = document.createElement('button');
            viewbutton.id = 'viewbutton';
            viewbutton.className = 'view_button';
            viewbutton.textContent = 'click vào xem';
            // Append the button to the parent of the shockElement (image-container)
            shockElement.appendChild(viewdiv);
            shockElement.appendChild(viewbutton);

            // Add click event listener to the button
            viewbutton.addEventListener('click', () => {
                // Remove the blur effect
                shockElement.classList.remove('blurred');
                shockElement.classList.remove('hiden_img');
                // Hide the button
                viewdiv.classList.add('hidden');
                viewbutton.classList.add('hidden');
            });
        })
    });
</script>
<script>
    // Lấy phần tử có id là 'bai-viet'
    let baiVietElement = document.getElementById('bai-viet');
    if (baiVietElement) {
        let pElements = baiVietElement.getElementsByTagName('p');
        for (let i = 0; i < pElements.length; i++) {
            pElements[i].style.color = '#000000'; // Ghi đè CSS trước đó
            pElements[i].style.fontWeight = 400;
            pElements[i].style.fontSize = '13px';
            pElements[i].style.lineHeight = '27px';
        }
    }

    let imgElements = baiVietElement.getElementsByTagName('img');
    if (imgElements) {
        for (let i = 0; i < imgElements.length; i++) {
            // convert link img
            if (imgElements[i].src.startsWith('<?php echo $local ?>/ckeditor/uploads/') == true) {
                let urlParts = imgElements[i].src.split('/');
                let fileName = urlParts[urlParts.length - 1];
                imgElements[i].src = '<?php echo $local ?>/admin/ckeditor/uploads/' + fileName;
            }

             //hiển thị css img chatbox
            if (imgElements[i].src.startsWith('https://benhxahoi.phongkhamdakhoanhatviet.vn/ckfinder/userfiles/images/Chat/Chat-Dakhoa.gif') == true) {
                imgElements[i].style.borderRadius = '8px';
                let divWrapper = document.createElement('p');
                divWrapper.className = 'glow-on-hover';
                imgElements[i].parentNode.insertBefore(divWrapper, imgElements[i]);
                divWrapper.appendChild(imgElements[i])
            }
        }

    }
</script>
<script>
    // Lấy phần tử có id là 'bai-viet'
    let baiVietElement1 = document.getElementById('bai-viet');
    if (baiVietElement) {
        let h2Elements = baiVietElement.getElementsByTagName('h2');
        for (let i = 0; i < h2Elements?.length; i++) {
            h2Elements[i].style.color = '#0060A7';
            h2Elements[i].style.fontWeight = '700';
            h2Elements[i].style.fontSize = '25px';
            h2Elements[i].style.textTransform = 'capitalize';
            // h2Elements[i].style.marginLeft = '10px';
            h2Elements[i].style.background = 'url("<?php echo $local ?>/images/icons/icon_cong.webp") no-repeat left center';
            h2Elements[i].style.backgroundSize = '30px 30px';
            h2Elements[i].style.paddingLeft = '35px';

        }

        let h3Element = baiVietElement.getElementsByTagName('h3');

        for (let i = 0; i < h3Element.length; i++) {
            h3Element[i].style.color = '#00D8D8';
            h3Element[i].style.fontWeight = '700';
            h3Element[i].style.fontSize = '21px';
            h3Element[i].style.textTransform = 'capitalize';
            // h3Element[i].style.marginLeft = '10px';
            h3Element[i].style.background = 'url("<?php echo $local ?>/images/icons/icon_mui.gif") no-repeat left center';
            h3Element[i].style.backgroundSize = '25px 25px';
            h3Element[i].style.paddingLeft = '35px';
        }
    }
</script>