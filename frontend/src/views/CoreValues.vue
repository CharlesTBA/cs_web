<template>
  <div>
    <section class="inner-banner bg-overlay-black-70" style="background-image: url('@/assets/images/holycross.jpg'); background-size: cover;">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Campus Core Values</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="space-ptb text-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10">
            <div class="section-title">
              <h2>Core Values</h2>
              <p>This is CHCC, we are Crossian's!</p>
            </div>

            <hr class="border">

            <h1 class="text-primary mt-3">Core Values</h1>
            <div class="core-values">
              <p v-for="(value, index) in coreValues" :key="index" class="value-item">
                • {{ value }}
              </p>
            </div>

            <p class="motto"><b><i>Hail to the Cross, our only hope!</i></b></p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'CoreValues',
  data() {
    return {
      coreValues: [
        'Holistic Education',
        'Committed Educators',
        'Compassionate Graduates'
      ]
    }
  }
}
</script>

<style scoped>
.border {
  border: 10px solid darkblue;
  border-radius: 5px;
  margin: 30px 0;
}

.core-values {
  margin: 30px 0;
}

.value-item {
  font-size: x-large;
  margin: 15px 0;
}

.motto {
  font-size: x-large;
  margin-top: 30px;
}

.text-primary {
  color: #007bff;
}
</style>