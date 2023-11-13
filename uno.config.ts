import {
    defineConfig,
    presetAttributify,
    presetIcons,
    presetTypography,
    presetUno,
    // presetWebFonts,
    // transformerDirectives,
    // transformerVariantGroup
} from 'unocss'

export default defineConfig({
    presets: [
        presetUno(),
        presetAttributify(),
        presetIcons(),
        presetTypography(),
    ],
    // include: [/.*\/anu-vue\.js(.*)?$/, './**/*.vue', './**/*.md'],
})