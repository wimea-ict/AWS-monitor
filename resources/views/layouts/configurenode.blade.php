@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Node configurations</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Station Name</th>
                                                    <th>Node Name</th>
                                                    <th>MAC Address</th>
                                                    <th>Txt key</th>
                                                    <th>Date registered</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>

                                     
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                <tr>
                                                    <td>Garrett Winters</td>
                                                    <td>Accountant</td>
                                                    <td>Tokyo</td>
                                                    <td>63</td>
                                                    <td>2011/07/25</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                <tr>
                                                    <td>Ashton Cox</td>
                                                    <td>Junior Technical Author</td>
                                                    <td>San Francisco</td>
                                                    <td>66</td>
                                                    <td>2009/01/12</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                <tr>
                                                    <td>Cedric Kelly</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>Edinburgh</td>
                                                    <td>22</td>
                                                    <td>2012/03/29</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                <tr>
                                                    <td>Airi Satou</td>
                                                    <td>Accountant</td>
                                                    <td>Tokyo</td>
                                                    <td>33</td>
                                                    <td>2008/11/28</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                <tr>
                                                    <td>Brielle Williamson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>New York</td>
                                                    <td>61</td>
                                                    <td>2012/12/02</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                <tr>
                                                    <td>Herrod Chandler</td>
                                                    <td>Sales Assistant</td>
                                                    <td>San Francisco</td>
                                                    <td>59</td>
                                                    <td>2012/08/06</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                <tr>
                                                    <td>Rhona Davidson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>Tokyo</td>
                                                    <td>55</td>
                                                    <td>2010/10/14</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                <tr>
                                                    <td>Colleen Hurst</td>
                                                    <td>Javascript Developer</td>
                                                    <td>San Francisco</td>
                                                    <td>39</td>
                                                    <td>2009/09/15</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal"> <i class="fa fa-thumbs-o-up"></i> Edit </button></td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->

                <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-full">
                                        <div class="modal-content">
                                           
                                            <div class="modal-body">
                                            <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Edit Node</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="wizard-validation-form" action="#" style="margin-bottom: 30px;">
                                    <div>
                                        
                                        <h3>Nodes Credentials</h3>
                                        <section>
                                        <div class="col-lg-12"> 
                                                    <div class="panel-group panel-group-joined" id="accordion-test"> 
                                                        <div class="panel panel-default"> 
                                                            <div class="panel-heading"> 
                                                                <h4 class="panel-title"> 
                                                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                                        Node Details
                                                                    </a> 
                                                                </h4> 
                                                            </div> 
                                                            <div id="collapseOne" class="panel-collapse collapse in"> 
                                                                <div class="panel-body">
                                                                <div class="form-group clearfix">
                                                                                    <div class="col-lg-4 col-lg-offset-4">
                                                                                    <select class="form-control">
                                                                                        <option>Makerere Station</option>
                                                                                        <option>Mbarara Station</option>
                                                                                        <option>Lyantonde Station</option>
                                                                                        
                                                                                    </select>
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                        <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label" for="userName2">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="nname" name="nname" type="text">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label" for="userName2">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="nnumber" name="nnumber" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="userName2">MAC address</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="mcaddress" name="mcaddress" type="text" class="form-control">

                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Date Registered</label>
                                                                                <div class="col-lg-4">
                                                                                <div class="input-group">
                                                                                    <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                </div>                                                                               </div>
                                                                            </div>

                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-12 control-label">Node Status configurations</label>
                                                                                
                                                                            </div>

                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="userName2">v_in_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_label" name="v_in_label" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_in_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_key_title" name="v_in_key_title" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_key_value" name="v_in_key_value" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="region" name="v_in_min_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_max_value" name="v_in_max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_label" name="v_mcu_label" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_key_title" name="v_mcu_key_title" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_key_value" name="v_mcu_key_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_max_value" name="v_mcu_max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_min_value" name="v_mcu_min_value" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                </div> 
                                                            </div> 
                                                        </div> 
                                                        
                                                    </div> 
                                                </div> 

                                        </section>
                                        <h3>Sensor Credentials</h3>
                                        <section>
                                            
                                        <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-2"> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                                                Sensor 1
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseOne-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                    <div class="col-lg-4 col-lg-offset-4">
                                                                                    <select class="form-control">
                                                                                        <option>Node 1</option>
                                                                                        <option>Node 2</option>
                                                                                        <option>Node 3</option>
                                                                                        
                                                                                    </select>
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control">
                                                                                </div>
                                                                    </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                                                                Sensor 2
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseTwo-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                            <div class="col-lg-4 col-lg-offset-4">
                                                                                    <select class="form-control">
                                                                                        <option>Node 1</option>
                                                                                        <option>Node 2</option>
                                                                                        <option>Node 3</option>
                                                                                        
                                                                                    </select>
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control">
                                                                                </div>
                                                                    </div>    
                                                        </div> 
                                                    </div> 
                                                </div> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                                                                Sensor 3
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseThree-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                    <div class="col-lg-4 col-lg-offset-4">
                                                                                    <select class="form-control">
                                                                                        <option>Node 1</option>
                                                                                        <option>Node 2</option>
                                                                                        <option>Node 3</option>
                                                                                        
                                                                                    </select>
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control">
                                                                                </div>
                                                                    </div>    
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div>   
                                        </section>
                                        
                                    </div>
                                </form>
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

                </div> <!-- End row -->
 

                                            </div>
                                            
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

@endsection