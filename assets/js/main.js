// Define the initialization function in the global scope
window.initKuesionerForm = function(likertData, textData) {
  return {
    // Form state management
    currentSection: 'likert', // 'likert' or 'text'
    
    // Likert section management
    likertCurrentQuestion: 0,
    likertQuestions: likertData,
    likertTotalQuestions: likertData.length,
    
    // Text section management
    textCurrentQuestion: 0,
    textQuestions: textData,
    textTotalQuestions: textData.length,
    
    // Progress calculations
    get overallProgress() {
      if (this.currentSection === 'likert') {
        return ((this.likertCurrentQuestion + 1) / (this.likertTotalQuestions + this.textTotalQuestions)) * 100;
      } else {
        return ((this.likertTotalQuestions + this.textCurrentQuestion + 1) / (this.likertTotalQuestions + this.textTotalQuestions)) * 100;
      }
    },
    
    // Likert section methods
    updateLikertAnswer(id, value) {
      this.likertQuestions.find(q => q.id === id).answer = value;
    },
    
    nextLikertQuestion() {
      const current = this.likertQuestions[this.likertCurrentQuestion];
      if (current.answer === null || current.answer === '') {
        alert('Silakan isi jawaban terlebih dahulu sebelum lanjut.');
        return;
      }
      
      if (this.likertCurrentQuestion < this.likertTotalQuestions - 1) {
        this.likertCurrentQuestion++;
      } else {
        // Transition to text questions
        this.currentSection = 'text';
      }
    },
    
    prevLikertQuestion() {
      if (this.likertCurrentQuestion > 0) {
        this.likertCurrentQuestion--;
      }
    },
    
    isFirstLikertQuestion() {
      return this.likertCurrentQuestion === 0;
    },
    
    isLastLikertQuestion() {
      return this.likertCurrentQuestion === this.likertTotalQuestions - 1;
    },
    
    // Text section methods
    updateTextAnswer(id, value) {
      this.textQuestions.find(q => q.id === id).answer = value;
    },
    
    nextTextQuestion() {
      const current = this.textQuestions[this.textCurrentQuestion];
      if (!current.answer || current.answer.trim() === '') {
        alert('Silakan isi jawaban terlebih dahulu sebelum lanjut.');
        return;
      }
      
      if (this.textCurrentQuestion < this.textTotalQuestions - 1) {
        this.textCurrentQuestion++;
      }
    },
    
    prevTextQuestion() {
      if (this.textCurrentQuestion > 0) {
        this.textCurrentQuestion--;
      } else {
        // Go back to likert questions
        this.currentSection = 'likert';
        this.likertCurrentQuestion = this.likertTotalQuestions - 1;
      }
    },
    
    isFirstTextQuestion() {
      return this.textCurrentQuestion === 0;
    },
    
    isLastTextQuestion() {
      return this.textCurrentQuestion === this.textTotalQuestions - 1;
    },
    
    // Form validation before submit
    validateForm() {
      // Check if all likert questions are answered
      const unansweredLikert = this.likertQuestions.filter(q => q.answer === null || q.answer === '');
      if (unansweredLikert.length > 0) {
        alert('Semua pertanyaan likert harus dijawab sebelum mengirim.');
        return false;
      }
      
      // Check if all text questions are answered
      const unansweredText = this.textQuestions.filter(q => !q.answer || q.answer.trim() === '');
      if (unansweredText.length > 0) {
        alert('Semua pertanyaan teks harus dijawab sebelum mengirim.');
        return false;
      }
      
      return true;
    }
  };
};