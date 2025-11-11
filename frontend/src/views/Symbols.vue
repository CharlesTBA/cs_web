<template>
  <div>
    <section class="inner-banner bg-overlay-black-70" style="background-image: url('@/assets/images/holycross.jpg'); background-size: cover;">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Campus Crossian's Symbols</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="space-ptb">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10">
            <div class="section-title text-center">
              <h2>Campus Crossian's Symbols</h2>
              <p>This is CHCC, we are Crossian's!</p>
            </div>

            <hr class="border">

            <h4>Campus Seal</h4>
            <ul class="list-unstyled symbols-list">
              <li v-for="(symbol, index) in symbols" :key="index" class="mb-2">
                <i class="fa fa-angle-right pr-2 mb-2"></i>
                <b>{{ symbol.name }}</b> - {{ symbol.description }}
              </li>
            </ul>

            <h4 class="mt-4">Phrase</h4>
            <b class="motto"><i>Hail to the Cross, our only hope!</i></b>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Symbols',
  data() {
    return {
      symbols: [
        {
          name: '"IN HOC SIGNO VINCES"',
          description: 'With this symbol you shall conquer.'
        },
        {
          name: 'Crusader',
          description: "It represent us Crossian's."
        },
        {
          name: "Crusader's shield with a cross",
          description: 'The symbol that represents IN HOC SIGNO VINCES'
        },
        {
          name: 'College Ribbon',
          description: 'Excellence, Competence and Compassion'
        },
        {
          name: 'Circular shapes.',
          description: 'Unity, wholeness and infinity towards achieving quality education.'
        }
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

.symbols-list li {
  font-size: x-large;
  margin-bottom: 20px !important;
}

.symbols-list b {
  color: #333;
}

.motto {
  font-size: x-large;
  display: block;
  margin-top: 20px;
}
</style>