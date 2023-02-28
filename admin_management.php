<div class='modal fade' id='instructorModel' tabindex='-1' aria-labelledby='instructorModel' aria-hidden='true'>
                    <div class='modal-dialog modal-xl'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='instructorModel'>Appoint Instructor</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                <h3>Current Instructor</h3>
                                <?php
                                        echo "<table class='table table-bordered table-striped'>
                                            <thead class='position-sticky top-0'>
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th class='col-2'>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyApInst'>";
                                        if($instructor != false){
                                            echo "<tr>
                                                    <td>{$instructor["name"]}</td>
                                                    <td class='col-2'><a href=#";
                                            echo " onclick='deleteInstructor(this)'>delete</a></td></tr>";  
                                        }
                                        
                                        echo "</tbody></table>";
                                ?>
                                </div>
                                <hr>
                                <h3>Available Instructors</h3>
                                <div class="col-12" >
                                <?php
                                    
                                        echo "<table class='table table-bordered table-striped'>
                                            <thead class='position-sticky top-0'>
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th class='col-2'>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyAvInst'>";
                                            if($appoint_instructors != false){
                                                foreach ($appoint_instructors as $key => $item) {
                                                    echo "<tr>
                                                            <td>{$item["name"]}</td>
                                                            <td class='col-2'>
                                                                <p class='id' style='display: none;'>{$item["id"]}</p>";
                                                    if($instructor != false){
                                                        echo "appoint";
                                                    }else{
                                                        echo "<a href=# id='{$item["id"]}' onclick='addInstructor(this)'>appoint</a>";
                                                    }        
                                                    echo "</td></tr>";
                                                }    
                                            }
                                        echo "</tbody></table>";
                                ?>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='button' onclick='location.reload()' class='btn btn-primary'>Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
                <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>Change Status</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                        <select class='form-control' name='status' id='status'>
                            <option val='waiting' selected>Waiting</option>
                            <option val='rejected'>Rejected</option>
                            <option val='accepted'>Accepted</option>
                        </select>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='button' onclick='saveStatus()' class='btn btn-primary'>Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
                <div class='modal fade' id='membersModel' tabindex='-1' aria-labelledby='membersModel' aria-hidden='true'>
                    <div class='modal-dialog modal-xl'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='membersModel'>Appointed Members</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                <h3>Current Members</h3>
                                <?php
                                        echo "<table class='table table-bordered table-striped'>
                                            <thead class='position-sticky top-0'>
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th class='col-2'>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyApMem'>";
                                        if($members != false){
                                            foreach ($members as $key => $item) {
                                                echo "<tr>
                                                    <td>{$item["name"]}</td>
                                                    <td style='text-transform: uppercase;'>{$item["role"]}</td>
                                                    <td class='col-2'><a href=# id='{$item["id"]}' onclick='deleteMember(this)'>delete</a></td></tr>";  
                                            }    
                                            
                                        }
                                        
                                        echo "</tbody></table>";
                                ?>
                                </div>
                                <hr>
                                <h3>Available Members</h3>
                                <div class="col-12" >
                                <?php
                                    
                                        echo "<table class='table table-bordered table-striped'>
                                            <thead class='position-sticky top-0'>
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th class='col-2'>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyAvMem'>";
                                            if($appoint_students != false){
                                                foreach ($appoint_students as $key => $item) {
                                                    echo "<tr>
                                                            <td>{$item["name"]}</td>
                                                            <td style='text-transform: uppercase;'>{$item["role"]}</td>
                                                            <td class='col-2'>
                                                            <a href=# id='{$item["id"]}' onclick='addMember(this)'>add</a>"; 
                                                    echo "</td></tr>";
                                                }    
                                            }
                                        echo "</tbody></table>";
                                ?>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='button' onclick='location.reload()' class='btn btn-primary'>Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>