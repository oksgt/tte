<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0">Upload Dokumen</h1> -->
            </div><!-- /.col -->
            <div class="col-sm-6">
                <!-- <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol> -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="file-upload">
                <!-- <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Upload Dokumen</button> -->
                <form action="<?= base_url('document/upload/')?>" method="post" enctype="multipart/form-data">
                <div class="image-upload-wrap">
                    <input class="file-upload-input" name="file_input" id="file_input" type='file' onchange="readURL(this);" accept="application/pdf" />
                    <div class="drag-text">
                        <h3>Drag and drop a file or select add Document</h3>
                    </div>
                </div>
                <div class="file-upload-content">
                    <!-- <img class="file-upload-image" src="#" alt="your file" /> -->
                    <span class="image-title">Uploaded File</span>
                    <hr>
                    <div class="image-title-wrap">
                        <button type="button" onclick="removeUpload()" class="remove-image"><i class="fas fa-times"></i></button>
                        <button type="submit" onclick="" class="file-upload-btn">Lanjutkan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->