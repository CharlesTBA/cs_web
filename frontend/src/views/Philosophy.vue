<template>
  <div>
    <section class="inner-banner bg-overlay-black-70" style="background-image: url('@/assets/images/holycross.jpg'); background-size: cover;">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Campus Philosophy</h1>
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
              <h2>Our Philosophy</h2>
              <p>This is HCC, we are HCCians!</p>
            </div>

            <hr class="border">

            <div class="philosophy-content">
              <p>
                Holy Cross College believes in the holistic development of individuals<br>
                by providing quality education through active participation<br>
                in the teaching-learning process.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Philosophy'
}
</script>

<style scoped>
.border {
  border: 10px solid darkblue;
  border-radius: 5px;
  margin: 30px 0;
}

.philosophy-content {
  margin: 40px 0;
}

.philosophy-content p {
  font-size: 1.25rem;
  line-height: 2;
  color: #333;
}
</style>