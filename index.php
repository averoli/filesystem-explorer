<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="./style.css" rel="stylesheet" />
  <script src="./scripts/script.js" type="module"></script>
  <title>System file explorer</title>
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand">Navbar</a>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <div class="row">
      <div class="col-md-3">
        <div class="ibox float-e-margins">
          <div class="ibox-content">
            <div class="file-manager">
              <form class="mb-0" action="/.php" method="post" enctype="multipart/form-data">
                Upload file:
                <input type="file" name="fileToUpload" id="fileToUpload">
              </form>
              <button id="createNewFolder">New</button>
              <?php


              try {
                $newFileName = "./root/3-create-write-file.txt";
                $fileContent = 'This is the content of the "3-create-write-file.txt" file.';

                // Now the file is created, but it's empty.
                $file = fopen($newFileName, "w");

                // Here we add the content to the file
                fwrite($file, $fileContent);

                // You can add new content to the file
                fwrite($file, "\nNew content in a new line.");

                $file = fopen($newFileName, "r");

                // Print the content
                $content = fread($file, filesize($newFileName));
                echo nl2br($content);

                // Close the file buffer
                fclose($file);
              } catch (Throwable $t) {
                echo $t->getMessage();
              }


              ?>
              <div class="hr-line-dashed"></div>
              <h5>Files</h5>
              <ul class="folder-list" style="padding: 0">
                <li><a href=""><i class="fa fa-folder"></i> Files</a></li>
                <li><a href=""><i class="fa fa-folder"></i> Pictures</a></li>
                <li><a href=""><i class="fa fa-folder"></i> Web pages</a></li>
                <li><a href=""><i class="fa fa-folder"></i> Illustrations</a></li>
                <li><a href=""><i class="fa fa-folder"></i> Films</a></li>
                <li><a href=""><i class="fa fa-folder"></i> Books</a></li>
              </ul>

              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9 animated fadeInRight">
        <div class="row">
          <div class="col-lg-12">
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-file"></i>
                  </div>
                  <div class="file-name">
                    Document_2014.doc
                    <br>
                    <small>Added: Jan 11, 2014</small>
                  </div>
                </a>
              </div>

            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/87CEFA/000000">
                  </div>
                  <div class="file-name">
                    Italy street.jpg
                    <br>
                    <small>Added: Jan 6, 2014</small>
                  </div>
                </a>

              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/FF7F50/000000">
                  </div>
                  <div class="file-name">
                    My feel.png
                    <br>
                    <small>Added: Jan 7, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-music"></i>
                  </div>
                  <div class="file-name">
                    Michal Jackson.mp3
                    <br>
                    <small>Added: Jan 22, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/FFB6C1/000000">
                  </div>
                  <div class="file-name">
                    Document_2014.doc
                    <br>
                    <small>Added: Fab 11, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="img-responsive fa fa-film"></i>
                  </div>
                  <div class="file-name">
                    Monica's birthday.mpg4
                    <br>
                    <small>Added: Fab 18, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <a href="#">
                <div class="file">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-bar-chart-o"></i>
                  </div>
                  <div class="file-name">
                    Annual report 2014.xls
                    <br>
                    <small>Added: Fab 22, 2014</small>
                  </div>
                </div>
              </a>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-file"></i>
                  </div>
                  <div class="file-name">
                    Document_2014.doc
                    <br>
                    <small>Added: Jan 11, 2014</small>
                  </div>
                </a>
              </div>

            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/4169E1/000000">
                  </div>
                  <div class="file-name">
                    Italy street.jpg
                    <br>
                    <small>Added: Jan 6, 2014</small>
                  </div>
                </a>

              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/EE82EE/000000">
                  </div>
                  <div class="file-name">
                    My feel.png
                    <br>
                    <small>Added: Jan 7, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-music"></i>
                  </div>
                  <div class="file-name">
                    Michal Jackson.mp3
                    <br>
                    <small>Added: Jan 22, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/008080/000000">
                  </div>
                  <div class="file-name">
                    Document_2014.doc
                    <br>
                    <small>Added: Fab 11, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="img-responsive fa fa-film"></i>
                  </div>
                  <div class="file-name">
                    Monica's birthday.mpg4
                    <br>
                    <small>Added: Fab 18, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <a href="#">
                <div class="file">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-bar-chart-o"></i>
                  </div>
                  <div class="file-name">
                    Annual report 2014.xls
                    <br>
                    <small>Added: Fab 22, 2014</small>
                  </div>
                </div>
              </a>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-file"></i>
                  </div>
                  <div class="file-name">
                    Document_2014.doc
                    <br>
                    <small>Added: Jan 11, 2014</small>
                  </div>
                </a>
              </div>

            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/40E0D0/000000">
                  </div>
                  <div class="file-name">
                    Italy street.jpg
                    <br>
                    <small>Added: Jan 6, 2014</small>
                  </div>
                </a>

              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/FF6347/000000">
                  </div>
                  <div class="file-name">
                    My feel.png
                    <br>
                    <small>Added: Jan 7, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-music"></i>
                  </div>
                  <div class="file-name">
                    Michal Jackson.mp3
                    <br>
                    <small>Added: Jan 22, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="image">
                    <img alt="image" class="img-responsive" src="https://via.placeholder.com/400x300/6A5ACD/000000">
                  </div>
                  <div class="file-name">
                    Document_2014.doc
                    <br>
                    <small>Added: Fab 11, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <div class="file">
                <a href="#">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="img-responsive fa fa-film"></i>
                  </div>
                  <div class="file-name">
                    Monica's birthday.mpg4
                    <br>
                    <small>Added: Fab 18, 2014</small>
                  </div>
                </a>
              </div>
            </div>
            <div class="file-box">
              <a href="#">
                <div class="file">
                  <span class="corner"></span>

                  <div class="icon">
                    <i class="fa fa-bar-chart-o"></i>
                  </div>
                  <div class="file-name">
                    Annual report 2014.xls
                    <br>
                    <small>Added: Fab 22, 2014</small>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>