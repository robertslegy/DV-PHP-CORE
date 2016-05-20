@extends('layout')

@section('header')
   <!-- page head start-->
            <div class="page-head">
                <h3>Service</h3><span class="sub-title">Welcome to
                Devless</span>            </div><!-- page head end-->
@endsection

@section('content')
    @include('error')
<div id="schema-table" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Tables</h4>
      </div>
      <div class="modal-body">
          <form id="form">
         <div  class="form-group">
            <label for="name-field">Table Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $service->name }}"/>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ $service->description }}</textarea>
        </div>
          <HR>
          <center> Add Fields </center>
          
          <div class="removeIndicator" id="fields" >
            <div  class="form-group">
            <label for="name-field">Field Name</label>
            <button type="button" class="btn btn-danger pull-right" id="delete-field" onclick="destroy_field('removeIndicator')">Remove</button>
            <input type="text" id="field-name"  name="field-name" class="form-control" value="{{ $service->name }}"/>
             </div>
           <div  class="form-group">
            <label for="field-type">Field Type</label>
            <?php $options = ['TEXT','TEXTAREA','PASSWORD','INTEGER','MONEY','PASSWORD','PERCENTAGE','URL','TIMESTAMP','BOOLEAN','EMAIL','REFERENCE'] ?>
            <select class="form-control"  name="field-type" id="field-type">
                @foreach($options as  $option)
                <option value="{{$option}}">{{$option}}</option>
                @endforeach
            </select>
        </div>
          <div class="form-group">
           <label for="default-field">Default Value(optional)</label>
            <input type="text" id="default" name="default" class="form-control" />
           </div>
            
            <div class="form-group">
                <label for="option-field">Field Options</label>
                
                  <input type="checkbox" id="required"  name="required"/>REQUIRED?
              
              
                  <input type="checkbox" id="validate" name="validate"/>VALIDATE?
              
              
                    <input type="checkbox" id="unique" name="unique"/> UNIQUE FIELD?
            </div>
      </div>
              <div class="dynamic-space"></div>
          
      <div class="modal-footer">
          <button type="button" onclick="append_field()" class="btn btn-info pull-left" >Add a Field</button>
          <button type="button" ONclick="create_table('{{$service->name}}')" class="btn btn-info pull-right" >Create Table</button>
      </div>
      </div></form></div>
  </div>
</div>
            <!--body wrapper start-->
            <div class="wrapper no-pad">
                <div class="profile-desk">
                    <aside class="p-short-info">
                        <div class="widget">
                            <div class="title">
                                <h1>Service Details</h1>
                            </div>
                            <form action="{{ route('services.update', $service->id) }}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div  class="form-group @if($errors->has('name')) has-error @endif">
                                    <label for="name-field">Name</label>
                                    <input type="text" id="name-field" name="name" class="form-control" value="{{ $service->name }}"/>
                                     @if($errors->has("name"))
                                        <span class="help-block">{{ $errors->first("name") }}</span>
                                     @endif
                                </div>
                                 <div  class="form-group @if($errors->has('active')) has-error @endif">
                                    <label for="active-field">State</label>
                                    <?php $options = ['Inactive','Active'] ?>
                                    <select class="form-control"  name="active" id="active-field">
                                        @foreach($options as $option_index => $option)
                                        <option @if($service->active == $option_index )selected @endif value="{{$option_index}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                     @if($errors->has("active"))
                                        <span class="help-block">{{ $errors->first("active") }}</span>
                                     @endif
                                </div>
                                 
                                
                                <div class="form-group">
                                    <label for="description-field">Description</label>
                                    <div class="">
                                        <textarea class="form-control" id="description-field" rows="3" name="description">{{ $service->description }}</textarea>
                                        @if($errors->has("description"))
                                        <span class="help-block">{{ $errors->first("description") }}</span>
                                        @endif
                                    </div>
                                </div>
                        </div>
                    </aside>
                    <aside class="p-aside">
                        <section class="isolate-tabs">
                            <header class="panel-heading tab-dark ">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active">
                                        <a data-toggle="tab" href="#jus">Database</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#mtab">Tables</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#jtab">Script</a>
                                    </li>
                                </ul>
                            </header>
                           
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="jus">
                                        <form role="form">
                                            <div class="form-group">
                                                <label for="g-title">Name</label>
                                                <input class="form-control" name="database" id="database"
                                                placeholder="" type="text">
                                                
                                        @if($errors->has("database"))
                                        <span class="help-block">{{ $errors->first("database") }}</span>
                                        @endif
                                         </div>
                                            
                                            <div class="form-group">
                                                <label for="g-txt" >Database Type</label>
                                                <select id="db-type" name="driver"  class="form-control m-b-10">
                                                    <option value="sqlite">SQLite</option>
                                                    <option value="mysql">MySQL</option>
                                                    <option value="">Postgress</option>
                                                    <option value="">SQL Server</option>
                                                </select>
                                                 @if($errors->has("driver"))
                                                  <span class="help-block">{{ $errors->first("driver") }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="g-txt">Host Name</label>
                                                <input class="form-control" name="hostname" id="hostname"
                                                placeholder="" type="text" value="127.0.0.1">
                                                 @if($errors->has("hostname"))
                                                  <span class="help-block">{{ $errors->first("hostname") }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="g-txt">Username</label>
                                                <input class="form-control" name="username" id="username"
                                                placeholder="" type="text" value="root">
                                                @if($errors->has("username"))
                                                  <span class="help-block">{{ $errors->first("username") }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="g-txt">Password</label>
                                                <input class="form-control" id="password" name="password" placeholder="" type="password">
                                                @if($errors->has("password"))
                                                  <span class="help-block">{{ $errors->first("password") }}</span>
                                                @endif
                                            </div>
                                            <button class="btn btn-info" type=
                                            "submit">Update</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="mtab">
                                                <section class="panel">
                    <header class="panel-heading head-border">
                        
                    </header>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                 @if(sizeOf($table_meta) > 0)
                                <tr>
                                    <th>#</th>
                                    <th>Table Name</th>
                                    <th>Description</th>
                                    <th>#N0 of Fields</th>
                                    
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach($table_meta as $table_data)
                                <tr id="{{$table_data['name']}}">
                                    <th scope="row">1</th>
                                    <td>{{$table_data['name']}}</td>
                                    <td>{{$table_data['description']}}</td>
                                    <td>{{sizeOf($table_data['field'])}} field(s)</td>
                                    <td><button class="btn btn-default">View Data</button>
                                        <button onclick="destroy_table('{{$table_data['name']}}','{{$service->name}}')" class="btn btn-danger">Destroy Table</button></td>
                                </tr>
                                    @endforeach
                                 @else
                                <h3 class="text-center alert alert-info">Empty!</h3>    
                                @endif
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#schema-table">New Table</button>
                    </div>
                </section>
                                    </div>
                                                                   <div class="tab-pane" id="jtab">

                                                                       
<textarea class="code-area" name="script" rows="20" style="width: 100%">

@if(!$service->script == "")
<?php echo "<?php \n"; ?>
{{$service->script}}
@else
<?php echo "<?php \n ";  ?> 
 echo "Happy scripting";
@endif
</textarea>
<button class="btn btn-info" type="submit">Run</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </aside>
                </div>
            </div><!--body wrapper end-->
<!--body wrapper end-->
<script>
    
    //split db_definition and populate field
    function db_definition(){
        var db_cred = '{{$service->db_definition}}';
        var sub_db_definition = db_cred.split(",")
        for(i=0; i< sub_db_definition.length; i++){
            
           var db_cred =sub_db_definition[i].split("=");
           $('#'+db_cred[0]).val(db_cred[1]);
           if(db_cred[0] == "driver"){
               driver_type = db_cred[1].toLowerCase();
               $("#db-type").val(driver_type);
           }
           
        
        }
    }
    //page initial run 
    function init(){
        window.count = 0;
        window.main_old_fields =  $('.removeIndicator').clone();
        db_definition();
        $('.code-area').ace({ theme: 'github', lang: 'php' });
        window.schema_json = {"resource":[{"name":"","description":"","field":[]}]  }        
    }
    //destroy table
    function destroy_table(table_name, service_name){
            var settings = {
           "async": true,
           "crossDomain": true,
           "url": "/api/v1/service/"+service_name+"/db",
           "method": "DELETE",
           "headers": {
             "content-type": "application/json",
             "cache-control": "no-cache",
           },
           "processData": false,
            "data": "{\"resource\":[{\"name\":\""+table_name+"\",\"params\":[{\"drop\":\"true\"}]}]}"
           }

         $.ajax(settings).done(function (response) {
             
           response_object = JSON.parse(response);
           status_code = response_object.status_code;
           if (status_code == 613) {
                $("").fadeOut();
           }
           else
           {
               alert('could not delete table ');
           }
         });
    }
    
  function append_field(){  
  field_names = ['name', 'description', 'field-name', 'field-type', 'default', 
            'required', 'validate', 'unique'];

  old_fields = window.main_old_fields.clone();
        field_names.forEach(
  function(i){
            field_name = i+window.count;
            old_fields.find('#'+i).attr('name', field_name ).attr('id', field_name );
            
       }
               
                
  )   
       
  new_fields = old_fields;
        
        $( ".dynamic-space").append(new_fields);
        old_fields.attr('class', 'fields'+window.count);
        old_fields.contents().each(function () {
            if (this.nodeType === 3) this.nodeValue = $.trim($(this).text()).replace(/removeIndicator/g, "fields"+window.count)
            if (this.nodeType === 1) $(this).html( $(this).html().replace(/removeIndicator/g, "fields"+window.count) )
            })
        window.count = window.count + 1 ;
        
        
    }

    
    function create_table(service_name){
         $.fn.serializeObject = function()
        {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
        
        object = $('#form').serializeObject();
        var array = $.map(object, function(value, index) {
        return [value];
        });
        count = 0
        jQuery(
            function($)
            {
              count = 0 ;
              form_array = [];
              $.each($('#form')[0].elements,
                     function(i,o)
                     {
                      var _this=$(o);
                      field_id = _this.attr('id');
                        
                       if(typeof field_id == "string" && field_id.indexOf("validate")>= 0){
                           form_array[count] = $('#'+_this.attr('id')).is(':checked'); 
                       }
                       else if(typeof field_id == "string" && field_id.indexOf("required")>= 0){
                           form_array[count] = $('#'+_this.attr('id')).is(':checked'); 
                       }
                       else if(typeof field_id == "string" && field_id.indexOf("unique")>= 0){
                           form_array[count] = $('#'+_this.attr('id')).is(':checked'); 
                       }else{
                           form_array[count] = $('#'+_this.attr('id')).val(); 
                       }
                        
                         
                    count++;
                     })
                
            }
          );
            
            if(form_array.length > 4){
            window.schema_json.resource[0].name = form_array[0];
            window.schema_json.resource[0].description = form_array[1];
            var len = ((form_array.length)-4)/7;
            console.log("number of fields are:",len);
            for (var i = 0; i < len; i++) {
                position = ((len-1)*7)
                if(form_array[5+position] == ""){ _default = "null";}else{_default = form_array[5+position]; }
                window.schema_json.resource[0].field[i] = {  
                    "name":form_array[3+position],
                    "field_type":form_array[4+position],
                    "default":_default,
                    "required":form_array[6+position],
                    "validation":form_array[7+position],
                    "is_unique":form_array[8+position],
                    "ref_table": ""
                 };
            }
               table_schema =  JSON.stringify(window.schema_json);
               var settings = {
                "async": true,
                "crossDomain": true,
                "url": "/api/v1/service/"+service_name+"/schema",
                "method": "POST",
                "headers": {
                  "content-type": "application/json",
                  "cache-control": "no-cache",
                },
                "processData": false,
                "data": table_schema
              }

            $.ajax(settings).done(function (response) {
              console.log(response);
              response_object = JSON.parse(response);
              status_code = response_object.status_code;
              message = response_object.message;
              if(status_code == 606){
                  
                  
                    location.reload();
                  
              }else{
                  alert(message);
              }
            });
            }
            else{
                alert('Sorry seems you have no fields set ');
            }
  
              
        
        
    }
   function destroy_field(field_id){
       $('.'+field_id).remove();
   }
</script> 
@endsection


 