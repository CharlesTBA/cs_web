<template>
  <div>
  <section class="inner-banner bg-overlay-black-70" :style="{ backgroundImage: `url(${hero})`, backgroundSize: 'cover' }">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Board of Trustees</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="space-ptb">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10 text-center">
            <div class="section-title">
              <h2>The Board of Trustees</h2>
              <p>Meet our institution's Board of Trustees</p>
            </div>
          </div>
        </div>

        <div class="row mb-xl-4">
          <!-- Trustees List -->
          <div v-for="trustee in trustees" :key="trustee.name" class="col-xl-3 col-lg-6 col-sm-6 mb-4">
            <div class="team">
              <div class="team-img">
                <img class="img-fluid" :src="trustee.image" :alt="trustee.name">
              </div>
              <div class="team-info">
                <a href="#" class="team-name">{{ trustee.name }}</a>
                <p class="team-leader">{{ trustee.position }}</p>
                <ul class="list-unstyled">
                  <li v-for="(social, index) in trustee.socials" :key="index">
                    <a :href="social.link"><i :class="social.icon"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Board',
  data() {
    return {
      hero: '/images/hole.png',
      trustees: [
        {
          name: 'Raquel T. Sta. Ines, PhD',
          position: 'Chairperson',
          image: 'http://holycross.edu.ph/img/team/3.jpg',
          socials: [
            { icon: 'fab fa-facebook-f', link: '#' },
            { icon: 'fab fa-twitter', link: '#' },
            { icon: 'fab fa-linkedin-in', link: '#' },
            { icon: 'fab fa-instagram', link: '#' }
          ]
        },
        {
          name: 'David P. Sta. Ines, Jr',
          position: 'Vice-Chairperson',
          image: 'http://holycross.edu.ph/img/team/2.jpg',
          socials: [
            { icon: 'fab fa-facebook-f', link: '#' },
            { icon: 'fab fa-twitter', link: '#' },
            { icon: 'fab fa-linkedin-in', link: '#' },
            { icon: 'fab fa-instagram', link: '#' }
          ]
        },
        {
          name: 'Dana Generosa SI. Marcelo',
          position: 'Member',
          image: 'http://holycross.edu.ph/img/team/5.jpg',
          socials: [
            { icon: 'fab fa-facebook-f', link: '#' },
            { icon: 'fab fa-twitter', link: '#' },
            { icon: 'fab fa-linkedin-in', link: '#' },
            { icon: 'fab fa-instagram', link: '#' }
          ]
        },
        {
          name: 'Dolores Raquel SI. Salvador, MD.',
          position: 'Member',
          image: 'http://holycross.edu.ph/img/team/6.jpg',
          socials: [
            { icon: 'fab fa-facebook-f', link: '#' },
            { icon: 'fab fa-twitter', link: '#' },
            { icon: 'fab fa-linkedin-in', link: '#' },
            { icon: 'fab fa-instagram', link: '#' }
          ]
        }
      ]
    }
  }
}
</script>

<style scoped>
/* Banner improvements */
.inner-banner {
  min-height: 400px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  margin-bottom: 2rem;
}
.inner-banner::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1;
}
.inner-banner .container {
  position: relative;
  z-index: 2;
}
.inner-banner h1 {
  font-size: 2.5rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-shadow: 0 2px 8px rgba(0,0,0,0.18);
}

/* Trustees grid improvements */
.row.mb-xl-4 {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 2rem;
  margin-top: 2rem;
}

.team {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 16px 0 rgba(0,0,0,0.07);
  padding: 1.5rem 1rem 1.2rem 1rem;
  transition: box-shadow 0.2s, transform 0.2s;
  text-align: center;
  position: relative;
}
.team:hover {
  box-shadow: 0 6px 24px 0 rgba(0,0,0,0.13);
  transform: translateY(-4px) scale(1.03);
}
.team-img {
  width: 100px;
  height: 100px;
  margin: 0 auto 1rem auto;
  border-radius: 50%;
  overflow: hidden;
  box-shadow: 0 2px 8px 0 rgba(0,0,0,0.10);
  background: #f3f4f6;
  display: flex;
  align-items: center;
  justify-content: center;
}
.team-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}
.team-info {
  padding: 0.5rem 0 0 0;
}
.team-name {
  color: #1e293b;
  text-decoration: none;
  font-weight: 600;
  font-size: 1.1em;
  margin-bottom: 0.2em;
  display: block;
  transition: color 0.2s;
}
.team-name:hover {
  color: #2563eb;
}
.team-leader {
  color: #64748b;
  margin: 8px 0 0 0;
  font-size: 0.98em;
}
.list-unstyled {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-top: 14px;
  padding: 0;
  list-style: none;
}
.list-unstyled a {
  color: #64748b;
  font-size: 1.1em;
  transition: color 0.2s;
}
.list-unstyled a:hover {
  color: #2563eb;
}

/* Responsive tweaks */
@media (max-width: 600px) {
  .inner-banner h1 {
    font-size: 1.5rem;
  }
  .row.mb-xl-4 {
    grid-template-columns: 1fr;
    gap: 1.2rem;
  }
  .team-img {
    width: 70px;
    height: 70px;
  }
}
</style>