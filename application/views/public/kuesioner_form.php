<!-- Views/public/kuesioner_form.php -->
<div class="container py-5">
    <div class="paper-card p-4 p-md-5">
        <div class="mb-4 border-bottom pb-3">
            <h2 class="fw-bold text-center">Kuesioner Likert</h2>
        </div>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger validation-error mb-4" role="alert">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <?php echo form_open('submit'); ?>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-medium">Nama: <?= $user->nama; ?> </label>
                <input type="hidden" name="nama" value="<?= $user->nama; ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Email: <?= $user->email; ?></label>
                <input type="hidden" name="email" value="<?= $user->email; ?>">
            </div>
        </div>


        <div class="mb-4 mt-5">
            <h3 class="fs-4 fw-bold mb-3">Pertanyaan</h3>
            <div class="bg-light p-3 rounded-3 mb-4">
                <p class="mb-0"><strong>Skala:</strong> 1 = Sangat Tidak Setuju, 2 = Tidak Setuju, 3 = Netral, 4 = Setuju, 5 = Sangat Setuju</p>
            </div>
        </div>

        <div x-data="{ 
        currentQuestion: 0,
        totalQuestions: <?php echo count($pertanyaan); ?>,
        questions: [
          <?php foreach ($pertanyaan as $index => $p): ?>
            { id: <?php echo $p->id; ?>, text: '<?php echo $p->pertanyaan; ?>', answer: null }<?php echo ($index < count($pertanyaan) - 1) ? ',' : ''; ?>
          <?php endforeach; ?>
        ],
        updateAnswer(id, value) {
          this.questions.find(q => q.id === id).answer = value;
        },
        nextQuestion() {
          if (this.currentQuestion < this.totalQuestions - 1) {
            this.currentQuestion++;
          }
        },
        prevQuestion() {
          if (this.currentQuestion > 0) {
            this.currentQuestion--;
          }
        },
        isLastQuestion() {
          return this.currentQuestion === this.totalQuestions - 1;
        },
        isFirstQuestion() {
          return this.currentQuestion === 0;
        }
      }">
            <div class="progress mb-4" style="height: 10px;">
                <div class="progress-bar" role="progressbar" x-bind:style="'width: ' + ((currentQuestion + 1) / totalQuestions * 100) + '%'"
                    x-bind:aria-valuenow="currentQuestion + 1" aria-valuemin="0" x-bind:aria-valuemax="totalQuestions"></div>
            </div>

            <template x-for="(question, index) in questions" :key="question.id">
                <div class="likert-scale-item mb-3 p-3 rounded shadow-sm" x-show="currentQuestion === index">
                    <p class="fs-5 mb-3" x-text="question.text"></p>
                    <div class="d-flex justify-content-between">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="text-center radio-likert">
                                <label class="d-flex flex-column align-items-center">
                                    <input type="radio"
                                        :name="'jawaban[' + question.id + ']'"
                                        :value="<?php echo $i; ?>"
                                        @click="updateAnswer(question.id, <?php echo $i; ?>)">
                                    <div class="mt-2 fw-medium"><?php echo $i; ?></div>
                                    <div class="small text-muted">
                                        <?php
                                        if ($i == 1) echo 'Sangat Tidak Setuju';
                                        elseif ($i == 2) echo 'Tidak Setuju';
                                        elseif ($i == 3) echo 'Netral';
                                        elseif ($i == 4) echo 'Setuju';
                                        elseif ($i == 5) echo 'Sangat Setuju';
                                        ?>
                                    </div>
                                </label>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </template>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-secondary cute-btn" @click="prevQuestion()" x-bind:disabled="isFirstQuestion()">
                    <i class="bi bi-chevron-left"></i> Sebelumnya
                </button>

                <template x-if="!isLastQuestion()">
                    <button type="button" class="btn btn-primary cute-btn" @click="nextQuestion()">
                        Selanjutnya <i class="bi bi-chevron-right"></i>
                    </button>
                </template>

                <template x-if="isLastQuestion()">
                    <button type="submit" class="btn btn-success cute-btn">
                        Kirim Jawaban <i class="bi bi-send"></i>
                    </button>
                </template>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>