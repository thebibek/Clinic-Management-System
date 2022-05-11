<script>
$(function() {
    var a = [
            [gd(2020,1,31), 400],
            [gd(2020,2,1), 658],
            [gd(2020,3,1), 198],
            [gd(2020,4,28), 663],
            [gd(2020,5,28), 801],
            [gd(2020,6,28), 1080],
            [gd(2020,7,28), 353],
            [gd(2020,8,28), 749],
            [gd(2020,9,28), 523],
            [gd(2020,10,28), 258],
            [gd(2020,11,28), 688],
            [gd(2020,12,28), 364]
        ],
        b = [
            [gd(2020,1,31), 251],
            [gd(2020,2,1), 558],
            [gd(2020,3,1), 298],
            [gd(2020,4,28), 563],
            [gd(2020,5,28), 301],
            [gd(2020,6,28), 980],
            [gd(2020,7,28), 453],
            [gd(2020,8,28), 349],
            [gd(2020,9,28), 423],
            [gd(2020,10,28), 258],
            [gd(2020,11,28), 188],
            [gd(2020,12,28), 164]
        ],
        c = [{
            label: "Sales",
            data: a,
            bars: {
                show: !0,
                lineWidth: 0,
                barWidth: 864e7,
                fillColor: {
                    colors: [{
                        opacity: 1
                    }, {
                        opacity: 1
                    }]
                }
            }
        }, {
            label: "Expenses",
            data: b,
            lines: {
                show: !0,
                lineWidth: 2,
                fillColor: {
                    colors: [{
                        opacity: 1
                    }, {
                        opacity: 1
                    }]
                }
            },
            points: {
                show: !0,
                radius: 4,
                fill: !0,
                fillColor: "#FFFFFF",
                lineWidth: 2
            }
        }],
        d = {
            series: {
                shadowSize: 0,
                bars: {
                    lineWidth: 2,
                    fillColor: {
                        colors: [{
                            opacity: 1
                        }, {
                            opacity: 1
                        }]
                    }
                }
            },
            grid: {
                hoverable: !0,
                clickable: !1,
                borderWidth: 1,
                tickColor: "#E5E5E5",
                borderColor: "#E5E5E5"
            },
            legend: {
                show: !0,
                position: "nw",
                noColumns: 0
            },
            tooltip: !0,
            tooltipOpts: {
                content: "%x: %y"
            },
            xaxis: {
                mode: "time",
                ticks: 6,
                tickDecimals: 0
            },
            yaxis: {
                ticks: 6,
                tickDecimals: 0
            },
            colors: ["#4286F7", "#E84234", "#F9BB06", "#32AB52"]
        };
    $.plot($("#combineChart"), c, d)
});

function gd(year, month, day) {
    return new Date(year, month, day).getTime();
}
</script>