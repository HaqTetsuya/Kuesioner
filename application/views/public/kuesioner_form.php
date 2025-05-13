<!-- Views/public/kuesioner_form.php -->
<div class="container py-5">
    <div class="paper-card p-4 p-md-5">
        <div class="mb-4 border-bottom pb-3">
            <h2 class="fw-bold text-center">Kuesioner</h2>
        </div>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger validation-error mb-4" role="alert">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <!-- Add script to convert PHP data to JS variable BEFORE Alpine initialization -->
        <script>
            // Convert PHP arrays to JavaScript arrays
            const likertQuestionData = [
                <?php foreach ($pertanyaan as $index => $p): ?>
                    { id: <?php echo $p->id; ?>, text: <?php echo json_encode($p->pertanyaan); ?>, answer: null }<?php echo ($index < count($pertanyaan) - 1) ? ',' : ''; ?>
                <?php endforeach; ?>
            ];
            
            const textQuestionData = [
                <?php foreach ($pertanyaan_text as $index => $p): ?>
                    { id: <?php echo $p->id; ?>, text: <?php echo json_encode($p->pertanyaan); ?>, answer: "" }<?php echo ($index < count($pertanyaan_text) - 1) ? ',' : ''; ?>
                <?php endforeach; ?>
            ];
        </script>

        <!-- Include your external JS file BEFORE using Alpine -->
        <script src="<?= base_url('assets/js/main.js'); ?>"></script>

        <?php echo form_open('submit', ['id' => 'kuesionerForm', '@submit.prevent' => 'validateForm() && $event.target.submit()']); ?>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-medium">Nama: <?= $user->nama; ?> </label>
                <input type="hidden" name="nama" value="<?= $user->nama; ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Email: <?= $user->email; ?></label>
                <input type="hidden" name="email" value="<?= $user->email; ?>">
                <input type="hidden" name="responden" value="<?= $user_id; ?>">
            </div>
        </div>

        <div x-data="initKuesionerForm(likertQuestionData, textQuestionData)">
            <!-- Progress Bar -->
            <div class="progress mb-4" style="height: 10px;">
                <div class="progress-bar" role="progressbar" x-bind:style="'width: ' + overallProgress + '%'"
                    x-bind:aria-valuenow="overallProgress" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            
            <!-- Section Title -->
            <div class="mb-4 mt-5">
                <h3 class="fs-4 fw-bold mb-3" x-text="currentSection === 'likert' ? 'Pertanyaan Skala Likert' : 'Pertanyaan Uraian'"></h3>
                
                <!-- Likert scale explanation -->
                <div class="bg-light p-3 rounded-3 mb-4" x-show="currentSection === 'likert'">
                    <p class="mb-0"><strong>Skala:</strong> 1 = Sangat Tidak Setuju, 2 = Tidak Setuju, 3 = Netral, 4 = Setuju, 5 = Sangat Setuju</p>
                </div>
                
                <!-- Text question explanation -->
                <div class="bg-light p-3 rounded-3 mb-4" x-show="currentSection === 'text'">
                    <p class="mb-0"><strong>Petunjuk:</strong> Silakan berikan jawaban singkat dan jelas untuk setiap pertanyaan.</p>
                </div>
            </div>

            <!-- Likert Questions Section -->
            <div x-show="currentSection === 'likert'">
                <template x-for="(question, index) in likertQuestions" :key="question.id">
                    <div class="likert-scale-item mb-3 p-3 rounded shadow-sm" x-show="likertCurrentQuestion === index">
                        <p class="fs-5 mb-3" x-text="question.text"></p>
                        <div class="d-flex justify-content-between">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div class="text-center radio-likert">
                                    <label class="d-flex flex-column align-items-center">
                                        <input type="radio"
                                            :name="'jawaban_likert[' + question.id + ']'"
                                            :value="<?php echo $i; ?>"
                                            :checked="question.answer === <?php echo $i; ?>"
                                            @click="updateLikertAnswer(question.id, <?php echo $i; ?>)">
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

                <!-- Likert Navigation Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary cute-btn" @click="prevLikertQuestion()" x-bind:disabled="isFirstLikertQuestion()">
                        <i class="bi bi-chevron-left"></i> Sebelumnya
                    </button>

                    <button type="button" class="btn btn-primary cute-btn" @click="nextLikertQuestion()">
                        <span x-text="isLastLikertQuestion() ? 'Lanjut ke Pertanyaan Uraian' : 'Selanjutnya'"></span>
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Text Questions Section -->
            <div x-show="currentSection === 'text'">
                <template x-for="(question, index) in textQuestions" :key="question.id">
                    <div class="text-question-item mb-3 p-3 rounded shadow-sm" x-show="textCurrentQuestion === index">
                        <p class="fs-5 mb-3" x-text="question.text"></p>
                        <div class="form-group">
                            <textarea 
                                class="form-control" 
                                rows="5" 
                                :name="'jawaban_text[' + question.id + ']'" 
                                x-model="question.answer"
                                placeholder="Tuliskan jawaban Anda di sini..."></textarea>
                        </div>
                    </div>
                </template>

                <!-- Text Question Navigation Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary cute-btn" @click="prevTextQuestion()">
                        <i class="bi bi-chevron-left"></i> Sebelumnya
                    </button>

                    <template x-if="!isLastTextQuestion()">
                        <button type="button" class="btn btn-primary cute-btn" @click="nextTextQuestion()">
                            Selanjutnya <i class="bi bi-chevron-right"></i>
                        </button>
                    </template>

                    <template x-if="isLastTextQuestion()">
                        <button type="submit" class="btn btn-success cute-btn">
                            Kirim Jawaban <i class="bi bi-send"></i>
                        </button>
                    </template>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>