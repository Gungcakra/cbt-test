@extends('layouts.admin')
@section('content')

<div class="flex flex-col gap-10 px-5 mt-5">
    <div class="breadcrumb flex items-center gap-[30px]">
        <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
        <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
        <a href="{{ route('dashboard.learning.index') }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">My Courses</a>
        <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
        <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Rapport Details</a>
    </div>
</div>
<div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
    <div class="flex gap-6 items-center">
        <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
            <img src="{{ Storage::url($course->cover)}}" class="w-full h-full object-contain" alt="icon">
            <p class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap">{{ $course->category->name }}</p>
        </div>
        <div class="flex flex-col gap-5">
            <h1 class="font-extrabold text-[30px] leading-[45px]">{{$course->name}}</h1>
            <div class="flex items-center">
                <div class="flex gap-[10px] items-center">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('images/icons/note-text.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold">{{$totalCorrectAnswer}} of {{ $totalQuestion }} correct</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center">
        <p class="p-[16px_20px] rounded-[10px] bg-[#{{ $passed ? '06BC65' : 'FD445E' }}] font-bold text-lg text-white outline-[#{{ $passed ? '06BC65' : 'FD445E' }}] outline-dashed outline-[3px] outline-offset-[7px] mr-[10px]">{{ $passed ? 'Passed' : 'Not Passed' }}</p>
        <!-- <p class="p-[16px_20px] rounded-[10px] bg-[#06BC65] font-bold text-lg text-white outline-[#06BC65] outline-dashed outline-[3px] outline-offset-[7px] mr-[10px]">Passed</p> -->
    </div>
</div>
<div class="result flex flex-col gap-5 mx-[70px] w-[870px] mt-[30px]">
    @forelse($studentAnswers as $answer)
        
    <div class="question-card w-full flex items-center justify-between p-4 border border-[#EEEEEE] rounded-[20px]">
        <div class="flex flex-col gap-[6px]">
            <p class="text-[#7F8190]">Question</p>
            <p class="font-bold text-xl">{{ $answer->question->question }}</p>
        </div>
        <div class="flex items-center gap-[14px]">
            <p class="bg-[#{{ $answer->answer === 'correct' ? '06BC65' : 'be1b1b' }}] rounded-full p-[8px_20px] text-white font-semibold text-sm">{{ $answer->answer }}</p>
        </div>
    </div>
    @empty
    <p class="font-bold">Belum ada jawaban</p>
    @endforelse

</div>
<div class="options flex items-center mx-[70px] gap-5 mt-[30px]">
    <a href="" class="w-fit h-[52px] p-[14px_20px] bg-[#0A090B] rounded-full font-semibold text-white transition-all duration-300 text-center">Request Retake</a>
    <a href="" class="w-fit h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Contact Teacher</a>
</div>
@endsection
