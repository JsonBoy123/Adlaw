 @extends("layouts.default")
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'Case Diary Management','description' => ''])
<div class="container container-div">
    <div class="row ">
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text pt-5 text-why">
            <h4 class="text-uppercase font-weight-bold ">CASE MANAGEMENT</h4>
            <p class="p-text">                                
               Adlaw offers a complete case management solution for lawyers, law firms and their clients. The features are stuffed with various sub-includes that empower you to accomplish more in lesser time. Here is a run-down of the sub-features – we encourage you to attempt our product for nothing but to audit its capacities altogether.
            </p>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mb-4">
                    <img src="{{asset('images/dashboard/image/case_add.png')}}" class="w-100 h-100" alt="Create Case">
                </div>
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mb-4">
                    <h4 class="text-uppercase font-weight-bold">Create Case</h4>
                    <p class="p-text">                                
                        You can add any number of cases by court, case type, CNR number and year. With our software you can retrieve relevant information and auto-fills subtleties, for example, clients, opponents, opponent advocates, Honorable judges and court hall etc. 
                    </p>
                    <p class="p-text">
                        Adlaw Case Management Software - Cases List Everything you have to record, including a crate to include an essential portrayal of the case, is given. You can allocate each case to all or a portion of the team members that you have added to the software with the end goal of coordinated effort. You can also record date of documenting and include an essential depiction about the case, customer or any pertinent specifics. Once you have a list of cases you can sort and view by 'running' closed’ or ‘transferred/NOC’ filters.
                    </p>
                </div>
            </div>
        	<div class="row">            
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mb-4">
                    <h4 class="text-uppercase font-weight-bold">Show cases list</h4>
                    <p class="p-text">
                        You can search cases by various criteria, for example, title, case number and more. There is no other quicker approach to discover and refer to cases, particularly in case you're working on various cases and have a full case diary. Here you can find All Cases, On Going Cases, Won Cases (Case Over in favor of client), Lost Cases (Case over against the favour) and Case that Withdrawn by client.
                    </p>
                </div> 
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mb-4">
                    <img src="{{asset('images/dashboard/image/case_show.png')}}" class="w-100 h-100" alt="Case Show">
                </div>  
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mb-4">
                    <img src="{{asset('images/dashboard/image/case_doc.png')}}" class="w-100 h-100" alt="Case Documents">
                </div>  
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mb-4">
                   <h4 class="text-uppercase font-weight-bold">Case Related Document</h4>
                    <p class="p-text">
                        You can also manage case related document. you can upload case related document on particular case wise.

                    </p>
                </div> 
            </div>
            <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mb-4">
                    <h4 class="text-uppercase font-weight-bold">Track Your Notes History</h4>
                    <p class="p-text">
                        Adlaw provide add your important information on your Legal Cases as Notes in order to maintain the Case History.

                    </p>
                </div> 
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mb-4">
                    <img src="{{asset('images/dashboard/image/case_notes_add.png')}}" class="w-100 h-100" alt="Case Notes">
                </div>  
            </div>
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('features.chat_or_messanger')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.client_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection