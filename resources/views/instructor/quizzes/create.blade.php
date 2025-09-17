@extends('layouts.instructor')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm p-4 animate__animated animate__fadeInUp">
            <h3 class="mb-3">Create New Quiz</h3>

            <form action="{{ route('instructor.quizzes.store') }}" method="POST" id="quizForm">
                @csrf

                {{-- Quiz Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Quiz Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                    {{-- Quiz Category --}}
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="" disabled selected>Select category</option>
                        <option value="trivia">Trivia (Easy)</option>
                        <option value="waste">Waste Sorting (Moderate)</option>
                        <option value="eco_plan">Eco Plan (Difficult)</option>
                    </select>
                </div>

                {{-- Quiz Difficulty --}}
                <div class="mb-3">
                    <label for="difficulty" class="form-label">Difficulty</label>
                    <select name="difficulty" id="difficulty" class="form-select" required>
                        <option value="" disabled selected>Select difficulty</option>
                        <option value="easy">Easy</option>
                        <option value="moderate">Moderate</option>
                        <option value="difficult">Difficult</option>
                    </select>
                </div>

                {{-- Quiz Level --}}
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <input type="number" name="level" id="level" class="form-control" required>
                </div>

                {{-- Access Code --}}
                <div class="mb-3">
                    <label for="access_code" class="form-label">Access Code</label>
                    <input type="text" name="access_code" id="access_code" class="form-control" required>
                </div>

                <hr>

                {{-- Questions Accordion --}}
                <div id="questionsAccordion">
                    <h5 class="mb-3">Questions</h5>

                    <div class="accordion-item question-card animate__animated animate__fadeIn">
                        <h2 class="accordion-header" id="heading0">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0">
                                Question 1
                            </button>
                        </h2>
                        <div id="collapse0" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="mb-2">
                                    <label class="form-label">Question</label>
                                    <input type="text" name="questions[0][text]" class="form-control" placeholder="Enter question" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Answers</label>
                                    <div class="answers-container">
                                        @for ($i = 0; $i < 4; $i++)
                                        <div class="d-flex mb-1 align-items-center">
                                            <input type="text" name="questions[0][answers][{{ $i }}][text]" class="form-control me-2" placeholder="Answer option" required>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="questions[0][correct]" value="{{ $i }}" required>
                                                <label class="form-check-label">Correct</label>
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger remove-question">Remove Question</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" id="addQuestionBtn" class="btn btn-primary mt-3 mb-3">
                    <i class="fas fa-plus me-1"></i> Add Another Question
                </button>

                <button type="submit" class="btn btn-accent w-100">
                    <i class="fas fa-save me-2"></i> Save Quiz
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let questionIndex = 1;

    // Add new question
    document.getElementById('addQuestionBtn').addEventListener('click', function() {
        const accordion = document.getElementById('questionsAccordion');

        const questionCard = document.createElement('div');
        questionCard.classList.add('accordion-item', 'question-card', 'animate__animated', 'animate__fadeIn');
        questionCard.innerHTML = `
            <h2 class="accordion-header" id="heading${questionIndex}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${questionIndex}">
                    Question ${questionIndex + 1}
                </button>
            </h2>
            <div id="collapse${questionIndex}" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="mb-2">
                        <label class="form-label">Question</label>
                        <input type="text" name="questions[${questionIndex}][text]" class="form-control" placeholder="Enter question" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Answers</label>
                        <div class="answers-container">
                            ${[0,1,2,3].map(i => `
                                <div class="d-flex mb-1 align-items-center">
                                    <input type="text" name="questions[${questionIndex}][answers][${i}][text]" class="form-control me-2" placeholder="Answer option" required>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="questions[${questionIndex}][correct]" value="${i}" required>
                                        <label class="form-check-label">Correct</label>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-question">Remove Question</button>
                </div>
            </div>
        `;

        accordion.appendChild(questionCard);

        questionIndex++;
    });

    // Remove question
    document.getElementById('questionsAccordion').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-question')) {
            e.target.closest('.accordion-item').remove();
        }
    });

    // SweetAlert Success Message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endpush
