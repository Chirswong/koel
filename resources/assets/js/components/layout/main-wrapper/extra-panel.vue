<template>
  <section id="extra" :class="{ showing: state.showExtraPanel }">
    <div class="tabs">
      <div class="clear" role="tablist">
        <button
          :aria-selected="currentTab === 'Lyrics'"
          @click.prevent="currentTab = 'Lyrics'"
          aria-controls="extraPanelLyrics"
          id="extraTabLyrics"
          role="tab"
        >
          Lyrics
        </button>
        <button
          :aria-selected="currentTab === 'Artist'"
          @click.prevent="currentTab = 'Artist'"
          aria-controls="extraPanelArtist"
          id="extraTabArtist"
          role="tab"
        >
          Artist
        </button>
        <button
          :aria-selected="currentTab === 'Album'"
          @click.prevent="currentTab = 'Album'"
          aria-controls="extraPanelAlbum"
          id="extraTabAlbum"
          role="tab"
        >
          Album
        </button>
        <button
          :aria-selected="currentTab === 'YouTube'"
          @click.prevent="currentTab = 'YouTube'"
          aria-controls="extraPanelYouTube"
          id="extraTabYouTube"
          role="tab"
          title="YouTube"
          v-if="sharedState.useYouTube"
        >
          <i class="fa fa-youtube-play"></i>
        </button>
      </div>

      <div class="panes">
        <div
          aria-labelledby="extraTabLyrics"
          id="extraPanelLyrics"
          role="tabpanel"
          tabindex="0"
          v-show="currentTab === 'Lyrics'"
        >
          <lyrics-pane :song="song" />
        </div>

        <div
          aria-labelledby="extraTabArtist"
          id="extraPanelArtist"
          role="tabpanel"
          tabindex="0"
          v-show="currentTab === 'Artist'"
        >
          <artist-info v-if="artist" :artist="artist" mode="sidebar"/>
        </div>

        <div
          aria-labelledby="extraTabAlbum"
          id="extraPanelAlbum"
          role="tabpanel"
          tabindex="0"
          v-show="currentTab === 'Album'"
        >
          <album-info v-if="album" :album="album" mode="sidebar"/>
        </div>

        <div
          aria-labelledby="extraTabAlbum"
          id="extraPanelAlbum"
          role="tabpanel"
          tabindex="0"
          v-show="currentTab === 'YouTube'"
        >
          <you-tube-video-list v-if="sharedState.useYouTube && song" :song="song"/>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts">
import isMobile from 'ismobilejs'
import Vue from 'vue'
import { eventBus, $ } from '@/utils'
import { events } from '@/config'
import { sharedStore, songStore, preferenceStore as preferences } from '@/stores'
import { songInfo } from '@/services'

type Tab = 'Lyrics' | 'Artist' | 'Album' | 'YouTube'
const defaultTab: Tab = 'Lyrics'

export default Vue.extend({
  components: {
    LyricsPane: () => import('@/components/ui/lyrics-pane.vue'),
    ArtistInfo: () => import('@/components/artist/info.vue'),
    AlbumInfo: () => import('@/components/album/info.vue'),
    YouTubeVideoList: () => import('@/components/ui/youtube-video-list.vue')
  },

  data: () => ({
    song: null as Song | null,
    state: preferences.state,
    sharedState: sharedStore.state,
    currentTab: defaultTab
  }),

  computed: {
    artist (): Artist | null {
      return this.song ? this.song.artist : null
    },

    album (): Album | null {
      return this.song ? this.song.album : null
    }
  },

  watch: {
    /**
     * Watch the "showExtraPanel" property to add/remove the corresponding class
     * to/from the html tag.
     * Some element's CSS can then be controlled based on this class.
     */
    'state.showExtraPanel': (showingExtraPanel: boolean): void => {
      if (showingExtraPanel && !isMobile.any) {
        $.addClass(document.documentElement, 'with-extra-panel')
      } else {
        $.removeClass(document.documentElement, 'with-extra-panel')
      }
    }
  },

  methods: {
    resetState (): void {
      this.currentTab = defaultTab
      this.song = songStore.stub
    },

    async fetchSongInfo (song: Song): Promise<void> {
      try {
        this.song = await songInfo.fetch(song)
      } catch (err) {
        this.song = song
        throw err
      }
    }
  },

  created (): void {
    eventBus.on({
      [events.SONG_STARTED]: async (song: Song): Promise<void> => await this.fetchSongInfo(song),
      [events.LOAD_MAIN_CONTENT]: (): void => {
        // On ready, add 'with-extra-panel' class.
        if (!isMobile.any) {
          $.addClass(document.documentElement, 'with-extra-panel')
        }

        // Hide the extra panel if on mobile
        if (isMobile.phone) {
          this.state.showExtraPanel = false
        }
      }
    })
  }
})
</script>

<style lang="scss">
@import "~#/partials/_vars.scss";

#extra {
  flex: 0 0 $extraPanelWidth;
  padding: 24px 16px;
  background: $colorExtraBgr;
  display: none;
  color: $color2ndText;
  overflow: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;

  html.touchevents & {
    // Enable scroll with momentum on touch devices
    overflow-y: scroll;
    -webkit-overflow-scrolling: touch;
  }

  &.showing {
    display: block;
  }

  h1 {
    font-weight: $fontWeight_UltraThin;
    font-size: 2.2rem;
    margin-bottom: 16px;
    line-height: 2.8rem;
  }

  @media only screen and (max-width : 1024px) {
    position: fixed;
    height: calc(100vh - #{$headerHeight});
    width: $extraPanelWidth;
    z-index: 5;
    top: $headerHeight;
    right: -100%;
    transition: right .3s ease-in;

    &.showing {
      right: 0;
    }
  }

  @media only screen and (max-width : 667px) {
    width: 100%;
  }
}
</style>
