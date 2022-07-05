const hideDropdown = () => {
	let dropdowns = document.querySelectorAll('.dropdown-list')
	for (let i = 0; i < dropdowns.length; i++) {
		dropdowns[i].classList.add('hide')
	}
}

const log = (toDisplay) => {
	console.log(toDisplay)
}

;(() => {
	let dropdowns = document.querySelectorAll('.dropdown-list')

	hideDropdown()
	let prevSelected = -1
	dropdowns = document.querySelector('header').querySelectorAll('.dropdown')
	for (let i = 0; i < dropdowns.length; i++) {
		dropdowns[i].addEventListener('click', (e) => {
			if (prevSelected !== i && prevSelected !== -1) {
				dropdowns[prevSelected].parentNode.querySelectorAll('.dropdown-list')[prevSelected].classList.add('hide')
			}
			e.currentTarget.querySelector('.dropdown-list').classList.toggle('hide')
			prevSelected = i
		})
	}
})()

// default global variables
// ;(() => {
// 	const iframe = window.document.createElement('iframe')
// 	iframe.src = 'about:blank'
// 	window.document.body.appendChild(iframe)
// 	const browserGlobals = Object.keys(iframe.contentWindow)
// 	window.document.body.removeChild(iframe)

// 	// Get the global variables added at runtime by filtering out the browser's
// 	// default global variables from the current window object.
// 	const runtimeGlobals = Object.keys(window).filter((key) => {
// 		const isFromBrowser = browserGlobals.includes(key)
// 		return !isFromBrowser
// 	})

// 	console.log('Runtime globals', runtimeGlobals)
// })()
