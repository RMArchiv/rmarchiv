import { autocomplete } from "@algolia/autocomplete-js";
import "@algolia/autocomplete-theme-classic";
import axios from "axios";

/**
 *
 * @param {Function} apiPath
 * @param {string} placeholder
 * @param {string} searchbarId
 * @param {string} searchContainerId
 * @param {Object} additionalProps
 */
export function createAutocomplete(
  apiPath,
  placeholder = "Search",
  searchbarId,
  searchContainerId,
  noResults,
  additionalProps = {}
) {
  const autocompleteSearch = autocomplete({
    container: `#${searchbarId}`,
    panelContainer: `#${searchContainerId}`,
    getSources() {
      return [
        {
          sourceId: "querySuggestions",
          getItems({ query }) {
            return axios.get(`/${apiPath()}/${query}`).then((result) => {
              return result.data;
            });
          },
          templates: {
            noResults({state, source, html}) {
              return html`<div class="empty-message">${noResults}</div>`;
            },
            item({ item, components, html }) {
            let htmlTemplate = html`<div class="card">
                <div class="card-header">
                    <a href='${ item.link }'>
                        ${item?.gameType && item?.gameTypeShort ? html`
                            <span class='typeiconlist'>
                                <span class='typei type_${item?.gameTypeShort} 'title='${ item?.gameType }'>
                                    ${ item?.gameType }
                                </span>
                            </span>`
                        :""}
                        <span class="platformiconlist">
                            <a href="${item?.makerLink}">
                                <span class="typei type_${item?.makerShort}" title="${item?.maker}">
                                    ${item?.maker}
                                </span>
                            </a>
                        </span>
                        <a href="${item?.urlGame}">
                            ${ item?.title }
                            ${item?.subtitle ? html`<small> - ${ item.subtitle }</small>`:""}
                        </a>
                        <span>
                            <img src="/assets/lng/16/${ item.languageIconURLSegment }.png" title="${ item.language }">
                        </span>
                    </a>
                </div>

<ul class="list-group">
    <li class="list-group-item media" style="margin-top: 0px;">
        <a class="pull-right" href="${item?.link}"><span class="badge">${item?.comments}</span></a>
        <a class="pull-left" href="${item?.link}">
            <img width="100px" class="img-responsive img-rounded" src='${item?.screenshot}' alt='${item.translation.titleScreenAlt}' title='${item.translation.titleScreenAlt}'/>
        </a>
        <div class="thread-info">
            <div class="media-heading">
                ${item.description}
                ${item.hasCdc ? html `
                    <div class="cdcstack">
                        <img src="/assets/cdc.png" title="${item.translation.coupdecoeur}" alt="${item.translation.coupdecoeur}">
                    </div>
                    `:""
                }
            </div>
            <div class="media-body" style="font-size: 12px;">
                <div>${item.developers}</div>
                <div>${item?.translation?.released ? item.translation.released:"release date"}: ${item.release}</div>
                <span> • </span>
                ${(item?.translation?.created ? item?.translation?.created :"hinzugefügt") +" "+ item.created }
                <span> • </span>
                <img src='/assets/rate_up.gif' alt='${item?.translation?.rate_up}'/> ${item.votesUp} -
                <img src='/assets/rate_down.gif' alt='${item?.translation?.rate_down}'/> ${item.votesDown}
                <span> • </span>
                AVG: ${item.average} ${item.average > 0 ?
                    html`<img src='/assets/rate_up.gif' alt='${item?.translation?.rate_up}'/>`
                    : item.average == 0 ? html`<img src='/assets/rate_neut.gif' alt='${item?.translation?.rate_neut}'/>` :html`<img src='/assets/rate_down.gif' alt='${item?.translation?.rate_down}'/>`
                }
                <!-- TO-DO TAGS -->
            </div>
        </div>
    </li>
</ul>


                </div>
            </div>
            `
            return htmlTemplate;
            },
          },
          ...additionalProps,
        },
      ];
    },
  });
}