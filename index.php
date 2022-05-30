<?php
session_start();
$_SESSION['root'] = "./assets/data/root";
$_SESSION['path'] = $_SESSION['root'];

//PATH
if (isset($_GET['path'])) {
  $_SESSION['path'] = $_GET['path'];
}

//DELETE
if (isset($_GET['delete'])) {
  $deleteFile = $_GET['delete'];
  $fullDeletePath = $_SESSION['path'] . '/' . $deleteFile;
  if (file_exists($fullDeletePath)) {
    unlink($fullDeletePath);
  }
  header('Location: ' . '?path=' . $_SESSION['path']);
}

//VIEW
if (isset($_GET['view'])) {
  $viewFileName = $_GET['view'];
  $_SESSION['media'] = $_SESSION['path'] . '/' . $viewFileName;
  header('Location: ' . $_SESSION['media']);
}

//REMOVE . AND ..
$fileListing = array_diff(scandir($_SESSION['path']), array('..', '.'));

$folders = array();
$files = array();

foreach ($fileListing as $file) {
  $fileInfo = $_SESSION['path'] . "/" . $file;
  if (is_dir($fileInfo)) {
    $folders[] = $file;
  } else {
    $files[] = $file;
  }
}

//IMAGE THUMBNAIL
function makeThumbnails($updir, $img, $id)
{
    $thumbnail_width = 134;
    $thumbnail_height = 189;
    $thumb_beforeword = "thumb";
    $arr_image_details = getimagesize("$updir" . $id . '_' . "$img"); // pass id to thumb name
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }
    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);
    if ($arr_image_details[2] == IMAGETYPE_GIF) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == IMAGETYPE_JPEG) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == IMAGETYPE_PNG) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }
    if ($imgt) {
        $old_image = $imgcreatefrom("$updir" . $id . '_' . "$img");
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        $imgt($new_image, "$updir" . $id . '_' . "$thumb_beforeword" . "$img");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="./assets/css/style.css" rel="stylesheet" />
  <script type="module" src="./assets/js/main.js"></script>
  <title>System file explorer</title>
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand">File System Explorer</a>
        <form class="d-flex" action="./assets/php/search.php" method="GET">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div class="row gx-0">
          <div class="col">
            <img id="userImg" src='https://randomuser.me/api/portraits/women/7.jpg' class="rounded-circle p-2" src="" alt="...">
          </div>
        </div>
      </div>
    </nav>

    <div class="row">

      <div class="col-md-2">
        <div class="ibox float-e-margins">
          <div class="ibox-content">
            <div class="file-manager">
              <div class="mb-3">
                <label for="fileToUpload" class="form-label">Upload file:</label>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModalLabel">Upload</button>
              </div>
              <hr />
              <div class="mb-3">
                <label for="fileToUpload" class="form-label">Create Dir:</label>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newFolderModal">New</button>
              </div>
              <hr />
              <div class="hr-line-dashed"></div>
              <h5>Files</h5>

              <div class="row">
                <ul class="bread_crumbs">
                  <?php
                  $breadCrumbsNames = explode("/", $_SESSION['path']);
                  $breadCPath = "";
                  $checkPath = ["assets", "data", "."];
                  foreach ($breadCrumbsNames as $key => $bredCrumb) {
                    if (!empty($breadCPath)) {
                      $breadCPath .= "/" . $bredCrumb;
                    } else {
                      $breadCPath = $bredCrumb;
                    }

                    $more = "";
                    if ((count($breadCrumbsNames) - 1) != $key) {
                      $more = "<span> > </span>";
                    }
                    if (!in_array($bredCrumb, $checkPath)) {
                      echo "<li><img src='./assets/data/images/folder_icon.png' width='12' />
                      <a href='?path=$breadCPath'>$bredCrumb</a> &nbsp;$more</li>";
                    }
                  }
                  ?>
                </ul>
              </div>
              <hr />
              <ul class="folder-list" style="padding: 0" id="folderList">
                <?php
                if (count($folders) == 0 && count($files) == 0) {
                  echo "<div>Folder is empty.</div>";
                }
                foreach ($folders as $fileName) {
                  $fileInfo = $_SESSION['root']  . "/" . $fileName;
                  $filePath = $_SESSION['path'] . '/' . $fileName;
                  echo "<li><img src='./assets/data/images/folder_icon.png' width='12' /><a href='?path=$filePath'>$fileName</a></li>";
                }
                ?>
              </ul>

              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8 animated fadeInRight">
        <div class="row">
          <div>
            <?php
            foreach ($folders as $fileName) {
              $fileInfo = $_SESSION['root']  . "/" . $fileName;
              $filePath = $_SESSION['path'] . '/' . $fileName;
              echo "<div class='file-box no-gutters'>
                          <div class='file'>
                            <a href='?path=$filePath'>
                              <span class='corner'></span>
                              <div class='icon'>
                                <i class='fa fa-folder'></i>
                              </div>
                              <div class='file-name'> $fileName <br>
                              <small>Added: Jan 11, 2014</small>
                              </div>
                            </a>
                          </div>
                        </div>";
            }

            foreach ($files as $fileName) {
              $file_Icon;
              $fullUrl = $_SERVER['REQUEST_URI'];
              $viewFile = $fullUrl . '&' . 'view=' .  $fileName;
              $deleteUrl = $fullUrl . '&' . 'delete=' .  $fileName;
              switch (pathinfo($fileName)['extension']) {
                case 'txt':
                case 'pdf':
                case 'doc':
                  $file_Icon = "<div class='icon'><i class='fa fa-file'></i></div>";
                  break;
                case 'png':
                case 'jpg':
                case 'jpeg':
                  $previewImg =  $_SESSION['path'] . '/' . $fileName;
                  $file_Icon = '<div class="image">
                  <a target="_blank" href='.$previewImg.'>
                    <img alt="image" class="img-responsive" src='.$previewImg.' style="width:200px">
                  </a></div>';
                  // $file_Icon = "<div class='icon'><i class='img-responsive fa fa-picture-o'></i></div>";
                  break;
                case 'webm':
                case 'mp4':
                case 'mpeg':
                  $file_Icon = "<div class='icon'><i class='img-responsive fa fa-film'></i></div>";
                  break;
                case 'flac':
                case 'mp3':
                  $file_Icon = "<div class='icon'><i class='fa fa-music'></i></div>";
                  break;
                default:
                  $file_Icon = "<div class='icon'><i class='fa fa-file'></i></div>";
                  break;
              };

              echo "<div class='file-box'>
              <div class='file'>
                <a href='javascript:;'>
                  <span class='corner'></span>
                    $file_Icon
                  <div class='file-name'> $fileName <br>
                  <small>Added: Jan 11, 2014</small> <br>
                  <a href='$viewFile' class='view_btn'>View</a>
                  <a href='$deleteUrl' class='delete_btn'>Delete</a>
                  </div>
                </a>
              </div>
            </div>";
            }
            ?>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Info
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <img src="./assets/data/images/file_icon.png" alt="">
                <p>File Name</p>
                <p>Creating date:</p><a href="">Value</a>
                <p>Last modify date:</p><a href="">Value</a>
                <p>Extension:</p><a href="">Value</a>
                <p>Size:</p><a href="">Value</a>
                <p>Author:</p><a href="">Value</a>
                <p>Description: Lorem ipsum dolor sit amet.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- MODAL FOR NEW FOLDER -->
  <div class="modal fade" id="newFolderModal" tabindex="-1" aria-labelledby="newFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newFolderModalLabel">New folder</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="./assets/php/create.php" method="POST">
            <div class="mb-3">
              <input type="text" class="form-control" name="folderName">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" name="folder-button" id="createNewFolder">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--END -->

  <!-- MODAL FOR UPLOAD -->
  <div class="modal fade" id="uploadModalLabel" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="mb-0" action="./assets/php/upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="fileToUpload" class="form-label">Upload file:</label>
              <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" value="Upload" name="submit" class="btn btn-primary" id="uploadFiles">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--END -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<!-- <a href='$viewFile' class='view_btn' data-bs-toggle='modal' data-bs-target='#viewModal'>
  View
</a>
<div class='modal fade' id='viewModal' tabindex='-1' aria-labelledby='newFolderModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='newFolderModalLabel'>$fileName</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <iframe width='560' height='315' src='./assets/php/open.php' frameBorder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowFullScreen></iframe>
      </div>
    </div>
  </div>
</div> -->