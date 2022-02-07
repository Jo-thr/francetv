<template>
  <nav class="metanav-dropdown-content" role="navigation">
    <div class="column">
      <!-- Chaînes -->
      <ul class="content-section">
        <li
          v-for="(chaine, index) in items.leftColumn.chaines"
          :key="index"
          class="item"
        >
          <span v-if="index === 0">{{ $t(chaine.title) }}</span>
          <a
            v-else
            :href="chaine.link"
            class="link text-common-tag"
            target="_blank"
            @click="
              $trackEvent('click', $event.target, {
                event_chapter1: 'metanav',
                event_name: $i18n.t(chaine.name),
              })
            "
          >
            {{ $t(chaine.name) }}
          </a>
        </li>
      </ul>

      <!-- France info -->
      <ul class="content-section">
        <li
          v-for="(franceinfo, index) in items.leftColumn.franceinfo"
          :key="index"
          class="item"
        >
          <span v-if="index === 0">{{ $t(franceinfo.title) }}</span>
          <a
            v-else
            :href="franceinfo.link"
            class="link"
            target="_blank"
            @click="
              $trackEvent('click', $event.target, {
                event_chapter1: 'metanav',
                event_name: $i18n.t(franceinfo.name),
              })
            "
          >
            {{ $t(franceinfo.name) }}
          </a>
        </li>
      </ul>

      <!-- Programme tv -->
      <ul class="content-section">
        <li class="item">
          <a
            class="link"
            :href="items.leftColumn.programmetv.link"
            target="_blank"
            @click="
              $trackEvent('click', $event.target, {
                event_chapter1: 'metanav',
                event_name: $i18n.t(items.leftColumn.programmetv.name),
              })
            "
          >
            {{ $t(items.leftColumn.programmetv.name) }}
          </a>
        </li>
      </ul>
    </div>

    <div class="column">
      <!-- Jeunesse -->
      <ul class="content-section">
        <li
          v-for="(jeunesse, index) in items.rightColumn.jeunesse"
          :key="index"
          class="item"
          @click="
            $trackEvent('click', $event.target, {
              event_chapter1: 'metanav',
              event_name: $i18n.t(items.rightColumn.plusbellelavie.name),
            })
          "
        >
          <span v-if="index === 0">{{ $t(jeunesse.title) }}</span>
          <a v-else :href="jeunesse.link" class="link" target="_blank">
            {{ $t(jeunesse.name) }}
          </a>
        </li>
      </ul>

      <!-- Plus belle la vie -->
      <ul class="content-section no-margin">
        <li class="item">
          <a
            class="link"
            :href="items.rightColumn.plusbellelavie.link"
            target="_blank"
            @click="
              $trackEvent('click', $event.target, {
                event_chapter1: 'metanav',
                event_name: $i18n.t(items.rightColumn.plusbellelavie.name),
              })
            "
          >
            {{ $t(items.rightColumn.plusbellelavie.name) }}
          </a>
        </li>
      </ul>

      <!-- La maison des maternelles -->
      <ul class="content-section no-margin">
        <li class="item">
          <a
            class="link"
            :href="items.rightColumn.lamaisondesmaternelles.link"
            target="_blank"
            @click="
              $trackEvent('click', $event.target, {
                event_chapter1: 'metanav',
                event_name: $i18n.t(
                  items.rightColumn.lamaisondesmaternelles.name
                ),
              })
            "
          >
            {{ $t(items.rightColumn.lamaisondesmaternelles.name) }}
          </a>
        </li>
      </ul>

      <!-- Allô docteurs -->
      <ul class="content-section">
        <li class="item">
          <a
            class="link"
            :href="items.rightColumn.allodocteurs.link"
            target="_blank"
            @click="
              $trackEvent('click', $event.target, {
                event_chapter1: 'metanav',
                event_name: $i18n.t(items.rightColumn.allodocteurs.name),
              })
            "
          >
            {{ $t(items.rightColumn.allodocteurs.name) }}
          </a>
        </li>
      </ul>

      <!-- France tv lab -->
      <ul class="content-section">
        <li class="item">
          <a
            class="link"
            :href="items.rightColumn.francetvlab.link"
            target="_blank"
            @click="
              $trackEvent('click', $event.target, {
                event_chapter1: 'metanav',
                event_name: $i18n.t(items.rightColumn.francetvlab.name),
              })
            "
          >
            {{ $t(items.rightColumn.francetvlab.name) }}
          </a>
        </li>
      </ul>

      <!-- Services -->
      <ul class="content-section">
        <li
          v-for="(service, index) in items.rightColumn.services"
          :key="index"
          class="item"
        >
          <span v-if="index === 0">{{ $t(service.title) }}</span>
          <a
            v-else
            :href="service.link"
            class="link"
            target="_blank"
            @click="
              $trackEvent('click', $event.target, {
                event_chapter1: 'metanav',
                event_name: $i18n.t(service.name),
              })
            "
          >
            {{ $t(service.name) }}
          </a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'MetanavItems',
  data() {
    return {
      items: {
        leftColumn: {
          chaines: [
            { title: 'navbar.metanav.dropdown.chaines' },
            {
              link: 'https://www.france.tv/france-2/',
              name: 'navbar.metanav.dropdown.france2',
            },
            {
              link: 'https://www.france.tv/france-3/',
              name: 'navbar.metanav.dropdown.france3',
            },
            {
              link: 'https://www.france.tv/france-4/',
              name: 'navbar.metanav.dropdown.france4',
            },
            {
              link: 'https://www.france.tv/france-5/',
              name: 'navbar.metanav.dropdown.france5',
            },
            {
              link: 'https://www.france.tv/slash/',
              name: 'navbar.metanav.dropdown.france-slash',
            },
            {
              link: 'https://la1ere.francetvinfo.fr/',
              name: 'navbar.metanav.dropdown.la-1ere',
            },
          ],
          franceinfo: [
            {
              title: 'navbar.metanav.dropdown.france-info',
            },
            {
              link: 'https://www.francetvinfo.fr/',
              name: 'navbar.metanav.dropdown.info-direct',
            },
            {
              link: 'https://france3-regions.francetvinfo.fr/',
              name: 'navbar.metanav.dropdown.actualites-regions',
            },
            {
              link: 'https://la1ere.francetvinfo.fr/',
              name: 'navbar.metanav.dropdown.actualites-outre-mer',
            },
            {
              link: 'https://sport.francetvinfo.fr/',
              name: 'navbar.metanav.dropdown.france-tv-sport',
            },
            {
              link: 'https://www.france.tv/spectacles-et-culture/',
              name: 'navbar.metanav.dropdown.actualites-culture',
            },
            {
              link: 'https://www.francetvinfo.fr/monde/afrique',
              name: 'navbar.metanav.dropdown.geopolis',
            },
          ],
          programmetv: {
            link: 'http://www.francetelevisions.fr/programme-tv',
            name: 'navbar.metanav.dropdown.programme-tv',
          },
        },

        rightColumn: {
          jeunesse: [
            { title: 'navbar.metanav.dropdown.jeunesse' },
            {
              link: 'https://www.france.tv/okoo/',
              name: 'navbar.metanav.dropdown.okoo',
            },
            {
              link: 'https://www.lumni.fr/',
              name: 'navbar.metanav.dropdown.lumni',
            },
          ],
          plusbellelavie: {
            link: 'https://www.plusbellelavie.fr',
            name: 'navbar.metanav.dropdown.plus-belle-la-vie',
          },
          lamaisondesmaternelles: {
            link: 'https://www.lamaisondesmaternelles.fr/',
            name: 'navbar.metanav.dropdown.maison-maternelle',
          },
          allodocteurs: {
            link: 'https://www.allodocteurs.fr/',
            name: 'navbar.metanav.dropdown.allo-docteurs',
          },
          francetvlab: {
            link: 'https://www.francetvlab.fr/',
            name: 'navbar.metanav.dropdown.france-tv-lab',
          },
          services: [
            {
              title: 'navbar.metanav.dropdown.services',
            },
            {
              link: 'https://www.francetelevisions.fr/et-vous',
              name: 'navbar.metanav.dropdown.france-tv-vous',
            },
            {
              link: 'http://leclub.francetv.fr',
              name: 'navbar.metanav.dropdown.france-tv-club',
            },
            {
              link: 'https://www.francetelevisions.fr/aide-et-contact',
              name: 'navbar.metanav.dropdown.aide-contact',
            },
          ],
        },
      },
    }
  },
}
</script>

<style lang="postcss" scoped>
.metanav-dropdown-content:hover {
  @apply block;
}

.column {
  @apply inline-block align-top;
}

.column:first-child {
  margin-right: 25px;
}

.content-section {
  @apply p-0 list-none;

  margin: 0 0 25px 0;
  padding: 0;
}

.no-margin {
  margin-bottom: 5px;
}

.content-section:last-child {
  @apply mb-0;
}

.item {
  @apply my-3 text-common-tag desktop:my-1;
}

.link {
  @apply text-white;
}

.item:first-child,
.item:first-child > .link {
  @apply font-bold text-mobile-h4;
}
</style>
