<?php
                  
                  // fetch data

                  $sql = "SELECT * FROM examstbl";
                  $res = mysqli_query($conn, $sql);
                  if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                      while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $examId = $row['examId'];
                        $examName = $row['examName'];
                        $class = $row['class'];
                        $course = $row['course'];
                        $date = $row['date'];
                        $status = $row['status'];
                       
                        ?>

labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        <?php
                      }
                    }
                }
                        ?>