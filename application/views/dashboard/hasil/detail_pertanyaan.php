<h4 class="mb-4"><?php echo $pertanyaan->pertanyaan; ?> <span class="badge bg-secondary"><?php echo ucfirst($pertanyaan->type); ?></span></h4>

<div class="table-responsive">
  <table class="table table-hover table-cute">
    <thead>
      <tr>
        <th>Responden</th>
        <th class="text-center">Jawaban</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($jawaban as $j): ?>
        <tr>
          <td>
            <a href="<?php echo base_url('kuesioner/detail_jawaban/' . $j->responden_id); ?>">
              <?php echo $j->responden; ?>
            </a>
          </td>
          <td class="text-center">
            <?php if ($pertanyaan->type == 'likert'): ?>
              <?php
                $bgColor = '';
                $textColor = 'text-white';
                if ($j->jawaban == 1) $bgColor = 'bg-danger';
                elseif ($j->jawaban == 2) $bgColor = 'bg-warning';
                elseif ($j->jawaban == 3) $bgColor = 'bg-info';
                elseif ($j->jawaban == 4) $bgColor = 'bg-primary';
                elseif ($j->jawaban == 5) $bgColor = 'bg-success';
              ?>
              <span class="badge rounded-pill <?php echo $bgColor . ' ' . $textColor; ?> px-3 py-2">
                <?php echo $j->jawaban; ?>
              </span>
            <?php else: ?>
              <?php echo $j->jawaban; ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
