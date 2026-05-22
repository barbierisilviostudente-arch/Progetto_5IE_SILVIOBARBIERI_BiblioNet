<?xml version="1.0" encoding="UTF-8"?><project name="Untitled Gantt Project" company="" webLink="http://" view-date="2025-12-29" view-index="0" gantt-divider-location="351" resource-divider-location="300" version="3.3.3316" locale="it_IT">
    <description/>
    <view zooming-state="default:7" id="gantt-chart">
        <field id="tpd3" name="Nome" width="200" order="0"/>
        <field id="tpd4" name="Data d'inizio" width="75" order="1"/>
        <field id="tpd5" name="Data di fine" width="75" order="2"/>
        <field id="tpd15" name="Note" width="20" order="3"/>
        <option id="filter.completedTasks" value="false"/>
        <option id="filter.dueTodayTasks" value="false"/>
        <option id="filter.overdueTasks" value="false"/>
        <option id="filter.inProgressTodayTasks" value="false"/>
        <option id="color.recent"><![CDATA[#666666 #009900 #ffcc33 #ff6633 #c80815 #0066ff]]></option>
    </view>
    <view id="resource-table">
        <field id="0" name="Nome" width="210" order="0"/>
        <field id="1" name="Ruolo predefinito" width="86" order="1"/>
    </view>
    <!-- -->
    <calendars>
        <day-types>
            <day-type id="0"/>
            <day-type id="1"/>
            <default-week id="1" name="default" sun="1" mon="0" tue="0" wed="0" thu="0" fri="0" sat="1"/>
            <only-show-weekends value="false"/>
            <overriden-day-types/>
            <days/>
        </day-types>
    </calendars>
    <tasks empty-milestones="true">
        <taskproperties>
            <taskproperty id="tpd0" name="type" type="default" valuetype="icon"/>
            <taskproperty id="tpd1" name="priority" type="default" valuetype="icon"/>
            <taskproperty id="tpd2" name="info" type="default" valuetype="icon"/>
            <taskproperty id="tpd3" name="name" type="default" valuetype="text"/>
            <taskproperty id="tpd4" name="begindate" type="default" valuetype="date"/>
            <taskproperty id="tpd5" name="enddate" type="default" valuetype="date"/>
            <taskproperty id="tpd6" name="duration" type="default" valuetype="int"/>
            <taskproperty id="tpd7" name="completion" type="default" valuetype="int"/>
            <taskproperty id="tpd8" name="coordinator" type="default" valuetype="text"/>
            <taskproperty id="tpd9" name="predecessorsr" type="default" valuetype="text"/>
        </taskproperties>
        <task id="0" uid="629d6f29c23e47cb842bee150f0c756f" name="Studio di Fattibilità" meeting="false" start="2025-10-03" duration="6" complete="0" expand="true"/>
        <task id="1" uid="c65a7fb57838470aa4fbb08443ceb780" name="Analisi dei Requisisti" color="#0066ff" meeting="false" start="2025-10-13" duration="6" complete="0" expand="true"/>
        <task id="2" uid="e23ceb68b1c24fa8b8ac35be4a1faa6b" name="Disegno" color="#c80815" meeting="false" start="2025-10-21" duration="58" complete="0" priority="2" expand="true"/>
        <task id="3" uid="e219b81440d5461f9bb49822609d06bb" name="Sviluppo" color="#ff6633" meeting="false" start="2026-01-08" duration="80" complete="0" priority="2" expand="true"/>
        <task id="4" uid="79ae751508c247529b7a9f60aaa3705d" name="Collaudo" color="#ffcc33" meeting="false" start="2026-04-21" duration="7" complete="0" priority="4" expand="true"/>
        <task id="5" uid="8ad6f9e2bcd24baa8cdd7194b4321848" name="Implementazione" color="#009900" meeting="false" start="2026-04-30" duration="1" complete="0" expand="true"/>
        <task id="6" uid="7f8c245e8f704e9ba6077756fe441709" name="Manutenzione" color="#666666" meeting="false" start="2026-05-01" duration="100" complete="0" priority="0" expand="true"/>
    </tasks>
    <resources/>
    <allocations/>
    <vacations/>
    <previous/>
    <roles roleset-name="Default"/>
</project>
