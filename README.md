# Projekt: Parkplatzverfügbarkeit Stadt St. Gallen

## Kurzbeschreibung des Projekts
Dieses Projekt bietet Analysen zur Parkplatzverfügbarkeit in Parkhäusern in der Stadt St. Gallen. Ein zentrales Element ist ein Diagramm, das zeigt, wann es am sinnvollsten ist, in welchem Parkhaus zu parken. Eine Zusatzfunktion ermöglicht dem Nutzer die Ankunftszeit einzugeben und zu sehen, welche 5 Parkhäuser zu diesem Zeitpunkt die meiste Kapazität haben und somit am wenigsten ausgelastet sein müssten. Eine Karte zeigt die Lage der Parkhäuser an und ermöglicht eine effiziente Parkplatzsuche.

## Learnings
1. **UI/UX Design:** Eine übersichtliche und nicht überladene Benutzeroberfläche ist entscheidend, um Infografiken effektiv darzustellen.
2. **Learning by Doing:** Praktisches Arbeiten im Code ist der schnellste und effektivste Weg zu lernen.
3. **Fehlersuche und Kommunikation:** Bei Unklarheiten sollte man immer nachfragen. Debugging ist dabei eine grosse Hilfe.
4. **Reihenfolge beim Laden von JS:** Die richtige Reihenfolge beim Laden von JavaScript-Dateien ist wichtig.
5. **Hard-Reload:** Manchmal sind Änderungen erst nach einem Hard-Reload sichtbar, was das Debugging erschweren kann.

## Schwierigkeiten
1. **Komplexität im UI/UX Design:** Das Balancieren zwischen ansprechendem Design und Übersichtlichkeit war herausfordernd.
2. **Fehlende Erfahrung:** Einige Teammitglieder mussten sich erst in neue Technologien und Tools einarbeiten.
3. **Kommunikation im Team:** Es war nicht immer einfach, alle Teammitglieder auf dem gleichen Wissensstand zu halten, besonders bei technischen Problemen.
4. **Laden von JavaScript-Dateien:** Die richtige Reihenfolge beim Laden der JavaScript-Dateien zu finden, war anfangs problematisch, insbesondere beim Dropdown-Menü.

## Reflexion
Während des Projekts standen wir vor grossen Herausforderungen, insbesondere im Bereich der Codierung, da unsere Gruppe nur begrenzte Erfahrung hatte. Die grösste Schwierigkeit war die fehlende Erfahrung einiger Teammitglieder, was die Kommunikation und den Wissenstransfer erschwerte. Das Laden von JavaScript-Dateien in der richtigen Reihenfolge war besonders beim Dropdown-Menü problematisch, aber durch Debugging und Teamarbeit konnten wir diese Probleme lösen. Trotz dieser Herausforderungen haben wir viel gelernt, insbesondere die Bedeutung von strukturierter Herangehensweise und effektiver Kommunikation im Team. Das Debugging hat uns Geduld und systematisches Vorgehen gelehrt, was uns in zukünftigen Projekten helfen wird, effizienter zu arbeiten.

## Vorgehen
Zuerst haben wir uns eine API ausgesucht, die uns die benötigten Daten zur Verfügung stellt. Bevor wir mit ETL (Extract, Transform, Load) begannen, haben wir uns zusammengesetzt und genau evaluiert, was wir machen wollten und welche Datensätze wir brauchen. Wir haben auch einen Prototyp auf Papier entwickelt.

Über ETL haben wir die Daten so vorbereitet, dass wir sie danach über einen Cronjob im 15-Minuten-Takt in unsere Datenbank speichern konnten. Während der Backend-Entwicklung wurde das Design (UX) entwickelt und gestaltet. Im Unload haben wir dann alle nötigen Daten aus dem Backend für das Frontend bereitgestellt. Anschliessend konnten wir mit dem Frontend beginnen. Danach war Debugging angesagt, sodass alles so funktionierte, wie wir es uns vorgestellt hatten. Diese Phase führte uns bis zum fertigen Projekt.

## Benutzte Ressourcen / Hilfsmittel (AI)
- **Google Maps:** Für die Darstellung der Parkhäuser auf der Karte.
- **API Schnittstelle Stadt St. Gallen:** Für aktuelle Daten zur Parkplatzverfügbarkeit.
- **ChatGPT:** Unterstützung bei technischen Fragen und Problemen.
- **CodePilot:** Zur Hilfe bei der Code-Entwicklung.
- **Internet:** Allgemeine Recherchen und Problemlösungen.
- **Figma:** Für das Design der Benutzeroberfläche.
- **Dozenten:** Unterstützung und Anleitung durch Lehrkräfte.

## Team
- **Emanuel Deuber:** Lead Design und Dokumentation
- **Dionys Hagmann:** Lead Coding
- **Jonas Meier:** Unterstützung in Design & Coding

## Informationen
- **Projekt:** Parkplatzverfügbarkeit Stadt St. Gallen
- **Team:** Dionys Hagmann, Emanuel Deuber, Jonas Meier
- **Studiengang:** Interaktive Medien – FS24
