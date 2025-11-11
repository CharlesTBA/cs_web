
<template>
  <div>
    <section class="inner-banner bg-overlay-black-70" style="background-image: url('@/assets/images/holycross.jpg'); background-size: cover;">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Campus Hymn</h1>
            </div>  
          </div>
        </div>
      </div>
    </section>

    <section class="space-ptb">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h1 class="text-primary">HOLY CROSS COLLEGE <br> HYMN</h1>
            <hr class="border">

            <div class="hymn-lyrics">
              <p v-for="(line, index) in hymnLines" :key="index">{{ line }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<script>
export default {
  name: 'Hymn',
  data() {
    return {
      hymnLines: [
        'For once, for all',
        'We are rallying together',
        'Behind you Alma Mater dear',
        'Who has elevated knowledge to us',
        'Inspiring us to sublimate your name.',
        'We students and alumni',
        'Wherever we may be',
        "Near or far we'll always be",
        'Loyal and ready to heed your call.',
        'For in the halls of Holy Cross College',
        'Our knowledge and love for God and country',
        'Radiates its light to our Alma Mater dear',
        'That guides us through the years.'
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

.hymn-lyrics {
  margin: 40px 0;
}

.hymn-lyrics p {
  font-size: x-large;
  margin: 10px 0;
  line-height: 1.6;
}

.text-primary {
  color: #007bff;
}
</style>