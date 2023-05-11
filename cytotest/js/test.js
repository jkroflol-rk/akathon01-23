var cy = cytoscape({

    container: document.getElementById('cy'), // container to render in

    elements: [ // list of graph elements to start with
        { // node a
            data: { id: 'a', name: 'Router' }
        },
        { // node b
            data: { id: 'b', name: 'Switch 3650' }
        },
        { // node c
            data: { id: 'c', name: 'Switch 2960' }
        },
        { // node d
            data: { id: 'd', name: 'PC-A' }
        },
        { // node e
            data: { id: 'e', name: 'PC-B' }
        },
        { // edge 1
            data: { id: 'e1', source: 'a', target: 'b' }
        },
        { // edge 2
            data: { id: 'e2', source: 'b', target: 'c' }
        },
        { // edge 3
            data: { id: 'e3', source: 'b', target: 'c' }
        },
        { // edge 4
            data: { id: 'bc', source: 'b', target: 'c' }
        },
        { // edge 5
            data: { id: 'cd', source: 'c', target: 'd' }
        },
        { // edge 6
            data: { id: 'ce', source: 'c', target: 'e' }
        }
    ],

    style: [ // the stylesheet for the graph
        {
            selector: 'node',
            style: {
                'background-color': '#666',
                'label': 'data(name)',
                'shape': 'rectangle',
                'font-size': 10
            }
        },

        {
            selector: 'node[id="a"]',
            style: {
                'background-image': './images/router.png',
                'background-fit': 'contain',
                'background-opacity': '0',

            }
        },

        {
            selector: 'node[id="b"]',
            style: {
                'background-image': './images/3650.png',
                'background-fit': 'contain',
                'background-opacity': '0',

            }
        },

        {
            selector: 'node[id="c"]',
            style: {
                'background-image': './images/sw.png',
                'background-fit': 'contain',
                'background-opacity': '0',

            }
        },

        {
            selector: 'node[id="d"], node[id="e"]',
            style: {
                'background-image': './images/pc.png',
                'background-fit': 'contain',
                'background-opacity': '0'
            }
        },

        {
            selector: 'edge',
            style: {
                'width': 3,
                'line-color': '#ccc',
                'curve-style': 'bezier',
                'control-point-step-size': 80,// change this value to adjust the curve
                'line-style': 'dashed',
                'line-dash-pattern': [6, 3],
                'font-size': 10,
                'label': 'Port 1 ->\nPort 2',
                'text-wrap': 'wrap',
                'text-max-width': '100px',
            }
        }
    ],

    layout: {
        name: 'dagre',
        rankDir: 'TB', // top to bottom
        rankSep: 100,
        nodeSep: 100
    },
});

