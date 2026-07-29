# Cloude Code ToolBox — MCP & Skills awareness

_Generated: 2026-07-25T10:21:17.069Z_

## How to use this report

- **Saved copy:** This file is **`.claude/cloude-code-toolbox-mcp-skills-awareness.md`** — refreshed whenever the toolbox runs an MCP & Skills scan (including on workspace open when auto-scan is enabled). It is meant for **Claude Code workspace context** together with `CLAUDE.md` (which gets a shorter replaceable summary when auto-merge is on).
- **MCP:** Lists **configured** servers from Claude Code config (`~/.claude.json` for user scope, `.mcp.json` for project scope). Use `/mcp` in the Claude Code panel to connect servers for your session.
- **Skills:** **On-disk** folders with `SKILL.md`. Claude Code does not auto-load them; attach `SKILL.md` or paths in chat when useful.
- **Task routing:** When the user’s request matches a server’s purpose (e.g. Confluence → Confluence/Atlassian MCP), prefer that **server id** from the tables below.

---

## MCP — workspace

Workspace `mcp.json` _(folder: pharma shop)_

- **c:\xampp\htdocs\pharma shop\.mcp.json** — _File missing_

_No active workspace servers in mcp.json._

## MCP — user profile

- **C:\Users\shrey\.claude.json** — _File exists — no servers defined_

_No active user-scoped servers in mcp.json._

## Skills (local `SKILL.md` folders)

### Project-scoped

_None found (or no workspace open)._

### User-scoped

- **accidental-data-loss-prevention** — `C:\Users\shrey\.copilot\skills\accidental-data-loss-prevention`
  - |

- **bigquery-ai-ml** — `C:\Users\shrey\.copilot\skills\bigquery-ai-ml`
  - Leverages BigQuery's built-in machine learning and GenAI capabilities

- **bigquery-bigframes** — `C:\Users\shrey\.copilot\skills\bigquery-bigframes`
  - Generates Python code using BigQuery DataFrames (BigFrames), the pandas/scikit-learn-style\

- **bigquery-data-transfer-service** — `C:\Users\shrey\.copilot\skills\bigquery-data-transfer-service`
  - Discovers and inspects BigQuery Data Transfer Service (DTS) configurations.

- **bigquery-graph** — `C:\Users\shrey\.copilot\skills\bigquery-graph`
  - Provides guidelines and best practices for querying and defining property

- **bigquery-sql** — `C:\Users\shrey\.copilot\skills\bigquery-sql`
  - Provides BigQuery SQL query optimization techniques, execution best practices,

- **building-data-apps** — `C:\Users\shrey\.copilot\skills\building-data-apps`
  - |

- **data-autocleaning** — `C:\Users\shrey\.copilot\skills\data-autocleaning`
  - Automated data quality and transformation capabilities for Dataform/dbt/BigQuery

- **dataform-bigquery** — `C:\Users\shrey\.copilot\skills\dataform-bigquery`
  - Expertise in generating clean, correct, and efficient Dataform pipeline

- **dbt-bigquery** — `C:\Users\shrey\.copilot\skills\dbt-bigquery`
  - Expert guidance for creating, modifying, and optimizing dbt pipelines

- **discovering-gcp-data-assets** — `C:\Users\shrey\.copilot\skills\discovering-gcp-data-assets`
  - |

- **enforcing-resource-attribution** — `C:\Users\shrey\.copilot\skills\enforcing-resource-attribution`
  - |

- **federate-lakehouse-catalog** — `C:\Users\shrey\.copilot\skills\federate-lakehouse-catalog`
  - Sets up Google Cloud Lakehouse federated catalogs to remote Iceberg

- **gcloud-auth-verification** — `C:\Users\shrey\.copilot\skills\gcloud-auth-verification`
  - Guidelines for identifying and resolving missing Google Cloud authentication

- **gcp-composer-troubleshooting** — `C:\Users\shrey\.copilot\skills\gcp-composer-troubleshooting`
  - Provides expert guidance for troubleshooting Cloud Composer (Apache

- **gcp-data-pipelines** — `C:\Users\shrey\.copilot\skills\gcp-data-pipelines`
  - Primary entry point for building, managing, and orchestrating data pipelines

- **gcp-dataflow** — `C:\Users\shrey\.copilot\skills\gcp-dataflow`
  - |

- **gcp-managed-airflow-migrations** — `C:\Users\shrey\.copilot\skills\gcp-managed-airflow-migrations`
  - Provides guidance for migrating Apache Airflow DAGs in Managed Service

- **gcp-pipeline-orchestration** — `C:\Users\shrey\.copilot\skills\gcp-pipeline-orchestration`
  - This skill helps the agent generate or update orchestration pipeline

- **gcp-pipeline-resource-provisioning** — `C:\Users\shrey\.copilot\skills\gcp-pipeline-resource-provisioning`
  - |

- **gcp-spark** — `C:\Users\shrey\.copilot\skills\gcp-spark`
  - |

- **gcs-security-assessment** — `C:\Users\shrey\.copilot\skills\gcs-security-assessment`
  - Assesses security posture, evaluates risks, and checks SAIF compliance

- **managing-python-dependencies** — `C:\Users\shrey\.copilot\skills\managing-python-dependencies`
  - |

- **ml-best-practices** — `C:\Users\shrey\.copilot\skills\ml-best-practices`
  - |

- **notebook-guidance** — `C:\Users\shrey\.copilot\skills\notebook-guidance`
  - |-

- **skill-repair** — `C:\Users\shrey\.copilot\skills\skill-repair`
  - |

---

## Suggested next steps

- **MCP:** Use this extension’s hub **MCP** tab, or `claude mcp list` in the terminal. In Claude Code, use `/mcp` to connect servers for the session.
- **Edit config:** Open `~/.claude.json` (user MCP) or `<workspace>/.mcp.json` (project MCP) via the extension commands.
- **Refresh this report:** run **Intelligence — scan MCP & Skills awareness** again after changing MCP config or adding skills.

_Report from Cloude Code ToolBox extension._
