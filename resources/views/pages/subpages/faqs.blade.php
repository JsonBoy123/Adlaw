@extends("layouts.default")
@section('title')
{{'ADLAW FAQ'}}
@endsection
@section('title','CRM for Law Firms Indore | Law Office Management Software | Adlaw')
@section('description','Get best CRM for law firms, lawyers and law school in Indore. Our law office management software will offer you to get the best CRM, lawyers, law firms and law schools.')
@section('keywords', 'CRM for law firms, online law office management software, lawyer office software, law CRM software, CRM for law firms, best CRM for lawyers')

@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'FREQUENTLY ASKED QUESTION (FAQ)','description' => 'Hello, How can we help you?'])

@php 
    $faqs = \App\Models\FaqsMast::where('status','1')->orderBy('seq_no')->get();

@endphp
<div class="container container-div">
    <div class="row">  
        <div class="col-md-12 pt-5">
            <div id="accordion">
                @foreach($faqs as $key => $faq)
                    <div class="card">
                        <div class="card-header" id="heading_{{$key}}">
                            <h5 class="m-1 faq-title"> <i class="fa fa-question-circle"></i> 
                              {{$faq->title}}
                              <a href="javascript:void(0)" class=" pull-right" data-toggle="collapse" data-target="#collapse_{{$key}}" aria-expanded="true" aria-controls="collapse_{{$key}}"><i class="fa fa-plus"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse_{{$key}}" class="collapse {{$key == 0 ? 'show' :''}}" aria-labelledby="heading_{{$key}}" data-parent="#accordion">
                          <div class="card-body p-4 text-why p-text">
                                {{-- <p class="p-text text-why"> --}}
                                    {!! $faq->description !!}
                                {{-- </p> --}}
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
                        
            </div> 
        </div>     
      {{--   <div class="col-sm-12 col-lg-12 col-xs-12 pt-5">
        	<h4 class="p-2" style="background-color:#58abdda3 !important;">What is Adlaw?</h4>
            <p class="p-text p-2">
            	Adlaw is an effective online platform that makes it quicker and simpler to discover and contract Top Rated Lawyers in any city/court in India since you deserve access to top-rate, proficient legal advice from Top Rated Lawyers out there. We are set to make the legal experience astonishing by making legal services brilliant, cost-effective and on-demand for each need you are user, lawyer or law student..
				Adlaw keeps everything in one spot the majority of your significant case subtleties — reports, contacts, schedules, messages, assignments, solicitations — are accessible in a solitary, sorted out area. Rather than looking crosswise over changed frameworks and programming with numerous login, monitor it all in adlaw. We help you to consult and contract the best legal advisers in India for District Courts, High Court and Supreme Court matters. Use filters to narrow your search and find the best advocate in India for your legitimate issue. Get top legal counselors in India for a family question or separation matters, property matter, work or work court matter, criminal issue, recuperation or check bob matters, tax collection or corporate issues, or an attorney master in some other field of law.
            </p>
            <h4 class="p-2" style="background-color:#58abdda3 !important;">Is my data secure?</h4>
            <p class="p-text p-2">
            	Absolutely; safety is our first priority. We follow bank-grade security, encrypting every bit of data which saves into the database.
            	<br>
				Apart from this, our software works on a dedicated server with Secure Socket Layer enabled. We also have a two-way authentication, which means every time you login, you will need to enter your password, and an OTP which will be sent automatically to your mobile number..
            </p>
            <h4 class="p-2" style="background-color:#58abdda3 !important;">What if I am an organization or have multiple users?</h4>
            <p class="p-text p-2">
            	You can register your organization and add as many users as you want at anytime after signup.       
            </p>
            <h4 class="p-2" style="background-color:#58abdda3 !important;">What types of cases does your law firm handle?</h4>
            <p class="p-text p-2">
            	We handle claims at all levels of litigation. Our areas of practice include Business Law, Employment and Labor Law, Intellectual Property/Technology Transactions, and Litigation.
            </p>
            <h4 class="p-2" style="background-color:#58abdda3 !important;">How can I become a client of your firm?</h4>
            <p class="p-text p-2">
            	Please call us at (0731) 404-3798 and speak with a member of our staff who will schedule for a consultation, at a time that is most convenient for you, with one of the firm’s attorneys. During your consultation the attorney will determine how our firm can best represent you and your case.
            </p>
            <h4 class="p-2" style="background-color:#58abdda3 !important;">How can I find a good lawyer in India?</h4>
            <p class="p-text p-2">
				The best way which is also the most common way of finding a good and competent lawyer anywhere in the world is from word of mouth. Talk to your friends and relatives, who then direct you to a lawyer or a law firm whom they know personally and deem them to be competent for the legal assistance needed by you, and shall honestly labour for you with the maximum possible use of law and facts in your favour. 
            </p>
            <p class="p-text">
            </p>
        </div> --}}
    </div>
</div>
<br></br>
@endsection